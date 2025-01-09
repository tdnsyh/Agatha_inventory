<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\DetailProduction;
use App\Models\Products;
use App\Models\Production;

#[Title('Update Production Request')]
class InventoryRequestUpdate extends Component
{

    public $title = "Update Production Request";
    public $text_subtitle = "This page displays the production request data to be changed.";

    public $id;
    public $details = [];
    public $selectedProductId = [];
    public $selectedQuantity = [];
    public $inventoryRequestId;
    public $requestDate;


    protected $rules = [
        'selectedProductId.*' => 'required|exists:products,id',
        'selectedQuantity.*' => 'required|integer|min:1',
    ];

    public function mount($id)
    {
        $this->id = $id;
        $production = Production::find($this->id);
        $this->inventoryRequestId = $production->inventory_request_id;
        $this->requestDate = $production->request_date;

        $this->details = DetailProduction::where('production_id', $this->id)->get();
        foreach ($this->details as $detail) {
            $this->selectedProductId[$detail->id] = $detail->product_id;
            $this->selectedQuantity[$detail->id] = $detail->quantity_produced;
        }
    }


    public function updateDetails()
    {
        $this->validate();
        foreach ($this->details as $detail) {
            $detail->update([
                'product_id' => $this->selectedProductId[$detail->id],
                'quantity_produced' => $this->selectedQuantity[$detail->id],
            ]);
        }

        session()->flash('message', 'Details updated successfully!');
    }

    public function render()
    {
        $products = Products::all();
        return view('livewire.manage-inventory.inventory-request.inventory-request-update', compact('products'));
    }
}
