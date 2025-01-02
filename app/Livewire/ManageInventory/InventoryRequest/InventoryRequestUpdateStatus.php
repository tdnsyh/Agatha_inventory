<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ProductionRequest;

#[Title('Update Production Request')]
class InventoryRequestUpdateStatus extends Component
{

    public $title = "Update Production Request";
    public $text_subtitle = "This page displays the production request data to be changed.";

    public $productionRequest;
    public $note;

    protected $rules = [
        'note' => 'nullable|string|max:255',
    ];

    public function mount($id)
    {

        $this->productionRequest = ProductionRequest::findOrFail($id);
        $this->note = $this->productionRequest->note;
    }

    public function updateStatus()
    {
        $this->validate();

        $this->productionRequest->update([
            'note' => $this->note,
        ]);

        session()->flash('message', 'Production request status updated successfully!');

        return redirect()->route('inventory.request.update-status', $this->productionRequest->id);
    }


    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-update-status');
    }
}
