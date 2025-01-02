<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ProductionRequest;

#[Title('Show Request Production')]
class InventoryRequestShow extends Component
{

    public $title = "Show Request Production";
    public $text_subtitle = "This page displays details of request production data.";
    public $productionRequest;

    public function mount($id)
    {
        $this->productionRequest = ProductionRequest::with('user', 'product')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-show');
    }
}
