<?php

namespace App\Livewire\ManageSales;

use App\Models\DetailSales;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

#[Title('Create Sales')]
class SalesCreate extends Component
{

    public $title = "Create Sales";
    public $text_subtitle = "This page displays for create data sales.";

    public $transaction_date;
    public $total_amount = 0;
    public $scan_barcode;
    public $quantity = 1;
    public $products = [];
    public $unit_price = 0;
    public $sub_total = 0;

    protected $rules = [
        'transaction_date' => 'required|date',
    ];

    public function mount()
    {
        $this->transaction_date = Carbon::now()->format('Y-m-d');
    }

    public function addProduct()
    {
        $product = Products::where('code', $this->scan_barcode)->first();

        if ($product) {
            $expiration_date = now()->addDays($product->expired_day)->toDateString();

            $this->products[] = [
                'product_code' => $product->code,
                'product_name' => $product->name,
                'variant' => $product->variant,
                'unit_price' => $product->price,
                'quantity' => $this->quantity,
                'expired_day' => $expiration_date,
                'sub_total' => $this->quantity * $product->price,
            ];

            $this->total_amount += $this->quantity * $product->price;

            $this->resetProductForm();
        } else {
            session()->flash('error', 'Product not found');
        }
    }

    public function removeProduct($index)
    {
        $this->total_amount -= $this->products[$index]['sub_total'];
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function saveSale()
    {
        // Validate the required fields before saving
        $this->validate();

        // Start a database transaction to ensure atomicity (everything is saved successfully or nothing is saved)
        DB::beginTransaction();

        try {
            // Create the sale record in the sales table
            $sale = Sales::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(), // Set current time or use $this->transaction_date if set manually
                'total_amount' => $this->total_amount, // Total amount of the sale
            ]);

            // Loop through each product in the sale and add a record to the detail_sales table
            foreach ($this->products as $product) {
                DetailSales::create([
                    'sales_id' => $sale->id,  // The ID of the sale just created
                    'product_id' => $product['product_code'],  // Assuming product_code corresponds to the product's ID
                    'quantity' => $product['quantity'],
                    'unit_price' => $product['unit_price'],
                    'sub_total' => $product['sub_total'],
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Flash a success message
            session()->flash('message', 'Sale saved successfully!');

            // Reset the component state (e.g., empty the product list, reset total amount)
            $this->reset();
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Optionally, log the error for debugging
            Log::error('Error saving sale: ' . $e->getMessage());

            // Flash an error message
            session()->flash('error', 'There was an error saving the sale.');
        }
    }

    public function resetProductForm()
    {
        $this->scan_barcode = '';
        $this->quantity = 1;
        $this->sub_total = 0;
    }


    public function render()
    {
        return view('livewire.manage-sales.sales-create');
    }
}
