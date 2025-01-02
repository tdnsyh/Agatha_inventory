<?php

namespace App\Livewire\ManageInventory\InventoryOut;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Inventory [OUT] List')]
class InventoryIndex extends Component {
    public $title = "Inventory [OUT] List";
    public $text_subtitle = "Inventory [OUT] List is used to display, manage, and monitor inventory data in the system";

    public function render() {
        return view('livewire.manage-inventory.inventory-out.inventory-index');
    }
}
