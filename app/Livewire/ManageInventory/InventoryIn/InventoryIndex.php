<?php

namespace App\Livewire\ManageInventory\InventoryIn;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\InventoryIn;

#[Title('Inventory [IN] List')]
class InventoryIndex extends Component
{

    public $title = "Inventory [IN] List";
    public $text_subtitle = "Inventory [IN] List is used to display, manage, and monitor inventory data in the system";

    public function render()
    {
        $inventoryIn = InventoryIn::with('product')
            ->leftJoin('detail_production', 'inventory_in.batch_code', '=', 'detail_production.batch_code')
            ->select('inventory_in.*', 'detail_production.quantity_produced')
            ->get();

        return view('livewire.manage-inventory.inventory-in.inventory-index', compact('inventoryIn'));
    }
}
