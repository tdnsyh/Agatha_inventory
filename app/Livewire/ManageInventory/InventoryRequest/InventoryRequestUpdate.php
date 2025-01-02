<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ProductionRequest;

#[Title('Update Production Request')]
class InventoryRequestUpdate extends Component
{

    public $title = "Update Production Request";
    public $text_subtitle = "This page displays the production request data to be changed.";

    public $productionRequest;
    public $product_id;
    public $quantity_request;
    public $request_date;
    public $note;

    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'quantity_request' => 'required|integer|min:1',
        'request_date' => 'required|date',
    ];

    public function mount($id)
    {
        $this->productionRequest = ProductionRequest::findOrFail($id);
        $this->product_id = $this->productionRequest->product_id;
        $this->quantity_request = $this->productionRequest->quantity_request;
        $this->request_date = $this->productionRequest->request_date;
        $this->note = $this->productionRequest->note;
    }

    public function updateRequest()
    {
        $this->validate();

        $this->productionRequest->update([
            'product_id' => $this->product_id,
            'quantity_request' => $this->quantity_request,
            'request_date' => $this->request_date,
            'note' => $this->note,
        ]);

        session()->flash('message', 'Production Request updated successfully!');
        return back();
    }


    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-update');
    }
}
