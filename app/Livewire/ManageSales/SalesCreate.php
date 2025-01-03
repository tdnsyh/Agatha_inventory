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
                'product_id' => $product->id,
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
        $this->validate();

        DB::beginTransaction();

        try {
            $sale = Sales::create([
                'user_id' => Auth::id(),
                'transaction_date' => $this->transaction_date,
                'total_amount' => $this->total_amount,
            ]);

            foreach ($this->products as $product) {
                $detail = DetailSales::create([
                    'sales_id' => $sale->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'unit_price' => $product['unit_price'],
                    'sub_total' => $product['sub_total'],
                ]);

                $productToUpdate = Products::find($product['product_id']);
                if ($productToUpdate) {

                    $productToUpdate->stock -= $product['quantity'];
                    $productToUpdate->save();
                }
            }

            DB::commit();

            session()->flash('message', 'Sale saved successfully!');

            $this->reset();
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error saving sale: ' . $e->getMessage());

            session()->flash('error', 'There was an error saving the sale: ' . $e->getMessage());
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
