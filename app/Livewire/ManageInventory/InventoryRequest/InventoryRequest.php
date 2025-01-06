<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailProduction;
use App\Models\Products;

#[Title('Inventory Request Production List')]
class InventoryRequest extends Component
{

    public $title = "Inventory Request Production List";
    public $text_subtitle = "Inventory Request Production List is used to display, manage, and monitor production request data in the system";

    public $productions;

    public function mount()
    {
        $this->productions = Production::with('details.product')
            ->where('inventory_user_id', Auth::id())
            ->get();
    }

    public function approve($productionId)
    {
        $production = Production::find($productionId);

        if ($production) {
            $production->update([
                'status' => 'approved',
                'approval' => true,
            ]);

            $detail = DetailProduction::where('production_id', $productionId)->first();

            if ($detail) {
                $product = Products::find($detail->product_id);
                $inventoryInData = [
                    'product_id' => $detail->product_id,
                    'inventory_date' => now()->toDateString(),
                    'batch_code' => $detail->batch_code,
                    'shelf_name' => $detail->shelf_name,
                    'initial_stock' => $detail->quantity_produced,
                    'final_stock' => $detail->quantity_produced,
                    'unit_price' => $product ? $product->price : 0,
                    'expiration_date' => $detail->expiration_date,
                ];

                \App\Models\InventoryIn::create($inventoryInData);

                if ($product) {
                    $product->update([
                        'stock' => $product->stock + $detail->quantity_produced,
                    ]);
                }
            }

            session()->flash('message', 'Production approved, inventory updated, and product stock updated successfully!');
        }
    }

    public function quantityMismatch($productionId)
    {
        $production = Production::find($productionId);
        if ($production) {
            $production->update([
                'status' => 'quantity mismatch',
            ]);

            session()->flash('message', 'Quantity mismatch reported!');
        }
    }

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request');
    }
}
