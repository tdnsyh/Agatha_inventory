<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ProductionRequest;

#[Title('Inventory Request Production List')]
class InventoryRequest extends Component
{

    public $title = "Inventory Request Production List";
    public $text_subtitle = "Inventory Request Production List is used to display, manage, and monitor production request data in the system";

    public function render()
    {
        $productionRequests = ProductionRequest::with('user', 'product')->get();
        return view('livewire.manage-inventory.inventory-request.inventory-request', compact('productionRequests'));
    }
}
