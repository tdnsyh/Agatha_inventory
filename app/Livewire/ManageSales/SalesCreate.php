<?php

namespace App\Livewire\ManageSales;

use App\Models\DetailSales;
use App\Models\InventoryIn;
use App\Models\InventoryOut;
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
        $inventory = InventoryIn::where('batch_code', $this->scan_barcode)->first();

        if ($inventory) {
            $existingProductKey = null;

            foreach ($this->products as $index => $product) {
                if ($product['batch_code'] === $inventory->batch_code) {
                    $existingProductKey = $index;
                    break;
                }
            }

            if ($existingProductKey !== null) {
                $this->products[$existingProductKey]['quantity'] += $this->quantity;
                $this->products[$existingProductKey]['sub_total'] = $this->products[$existingProductKey]['quantity'] * $inventory->unit_price;
            } else {
                $expiration_date = now()->addDays($inventory->product->expired_day)->toDateString();

                $this->products[] = [
                    'product_id' => $inventory->product_id,
                    'product_code' => $inventory->product->code,
                    'product_name' => $inventory->product->name,
                    'variant' => $inventory->product->variant,
                    'unit_price' => $inventory->unit_price,
                    'quantity' => $this->quantity,
                    'expired_day' => $expiration_date,
                    'sub_total' => $this->quantity * $inventory->unit_price,
                    'inventory_in_id' => $inventory->id,
                    'batch_code' => $inventory->batch_code,
                ];
            }

            $this->total_amount = 0;
            foreach ($this->products as $product) {
                $this->total_amount += $product['sub_total'];
            }

            $this->resetProductForm();
        } else {
            session()->flash('error', 'Batch code not found');
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

                $inventory = InventoryIn::find($product['inventory_in_id']);
                if ($inventory) {
                    $inventory->final_stock -= $product['quantity'];
                    $inventory->save();

                    InventoryOut::create([
                        'inventory_in_id' => $inventory->id,
                        'inventory_date' => $this->transaction_date,
                        'batch_code' => $product['batch_code'],
                        'shelf_name' => $inventory->shelf_name,
                        'initial_stock' => $inventory->final_stock,
                        'stock_sold' => $product['quantity'],
                        'unit_price' => $inventory->unit_price,
                    ]);
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
