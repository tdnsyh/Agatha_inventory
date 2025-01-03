<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\DetailProduction;
use App\Models\ProductionRequest;
use App\Models\Products;
use App\Models\InventoryIn;

#[Title('Create Production Request ')]
class ProductionRequestCreate extends Component
{

    public $title = "Create Production Request";
    public $text_subtitle = "This page displays for create data production.";

    public $productionRequestId;
    public $productionRequest;
    public $products = [];
    public $production_date;
    public $production_status = 'In Progress';
    public $note;
    public $shelf_name;

    public function mount($productionRequestId)
    {
        $this->productionRequest = ProductionRequest::with('product', 'user')->findOrFail($productionRequestId);
        $this->products = [$this->productionRequest->product];
    }

    public function saveProduction()
    {
        $this->validate([
            'production_date' => 'required|date',
            'production_status' => 'required|string',
        ]);

        $production = Production::create([
            'production_request_id' => $this->productionRequestId,
            'production_status' => $this->production_status,
            'production_date' => $this->production_date,
            'note' => $this->note,
            'user_id' => Auth::id(),
        ]);

        foreach ($this->products as $product) {
            $expiredDay = $product->expired_day;
            $expirationDate = \Carbon\Carbon::parse($this->production_date)->addDays($expiredDay);

            $batchCode = 'BC-' . strtoupper(Str::random(4));

            $detailProduction = DetailProduction::create([
                'production_id' => $production->id,
                'product_id' => $product->id,
                'batch_code' => $batchCode,
                'shelf_name' => $this->shelf_name,
                'quantity_produced' => $this->productionRequest->quantity_request,
                'expiration_date' => $expirationDate,
            ]);

            if ($this->production_status === 'Complete') {
                $productToUpdate = Products::find($product->id);
                if ($productToUpdate) {
                    InventoryIn::create([
                        'product_id' => $product->id,
                        'inventory_date' => $this->production_date,
                        'batch_code' => $batchCode,
                        'shelf_name' => $this->shelf_name,
                        'initial_stock' => $productToUpdate->stock,
                        'final_stock' => $productToUpdate->stock + $detailProduction->quantity_produced,
                        'unit_price' => $productToUpdate->price,
                        'expiration_date' => $expirationDate,
                    ]);

                    $productToUpdate->stock += $detailProduction->quantity_produced;
                    $productToUpdate->save();
                }
            }
        }

        $this->productionRequest->update(['status_request' => $this->production_status]);

        session()->flash('message', 'Production created successfully!');
    }

    public function render()
    {
        return view('livewire.manage-production.production-request-create', [
            'productionRequest' => $this->productionRequest,
        ]);
    }
}
