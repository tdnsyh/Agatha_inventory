<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Products;
use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionRequest;
use App\Models\DetailProduction;
use Illuminate\Support\Str;
use App\Models\InventoryIn;

#[Title('Create Production')]
class ProductionCreate extends Component
{

    public $title = "Create Production";
    public $text_subtitle = "This page displays for create data production.";

    public $production_request_id;
    public $production_status;
    public $note;
    public $production_date;
    public $shelf_name;
    public $selectedRequest;
    public $products;

    public function mount()
    {
        $this->products = [];
        $this->selectedRequest = null;
    }

    public function updatedProductionRequestId($value)
    {
        $this->selectedRequest = ProductionRequest::with('product')->find($value);
        if ($this->selectedRequest) {

            $this->products = Products::where('id', $this->selectedRequest->product_id)->get();
        }
    }

    public function saveProduction()
    {
        $this->validate([
            'production_request_id' => 'required',
            'production_status' => 'required',
            'production_date' => 'required|date',
        ]);

        $production = Production::create([
            'production_request_id' => $this->production_request_id,
            'production_status' => $this->production_status,
            'production_date' => $this->production_date,
            'note' => $this->note,
            'user_id' => Auth::id(),
        ]);

        $productionRequest = ProductionRequest::find($this->production_request_id);
        $productionRequest->status_request = $this->production_status;
        $productionRequest->save();

        foreach ($this->products as $product) {
            $expiredDay = $product->expired_day;
            $expirationDate = \Carbon\Carbon::parse($this->production_date)->addDays($expiredDay);
            $batchCode = 'BC-' . strtoupper(substr(uniqid(rand(), true), -4));

            $detailProduction = DetailProduction::create([
                'production_id' => $production->id,
                'product_id' => $product->id,
                'batch_code' => $batchCode,
                'shelf_name' => $this->shelf_name,
                'quantity_produced' => $this->selectedRequest->quantity_request,
                'expiration_date' => $expirationDate,
            ]);

            if ($this->production_status === 'Complete') {
                $productToUpdate = Products::find($product->id);
                if ($productToUpdate) {
                    $productToUpdate->stock += $detailProduction->quantity_produced;
                    $productToUpdate->save();

                    InventoryIn::create([
                        'product_id' => $product->id,
                        'inventory_date' => $this->production_date,
                        'batch_code' => $batchCode,
                        'shelf_name' => $this->shelf_name,
                        'initial_stock' => $productToUpdate->stock - $detailProduction->quantity_produced,
                        'final_stock' => $productToUpdate->stock,
                        'unit_price' => $productToUpdate->price,
                        'expiration_date' => $expirationDate,
                    ]);
                }
            }
        }

        session()->flash('message', 'Production saved successfully!');
    }

    public function render()
    {
        $productionRequests = ProductionRequest::with('product')->get();
        return view('livewire.manage-production.production-create', [
            'productionRequests' => $productionRequests
        ]);
    }
}
