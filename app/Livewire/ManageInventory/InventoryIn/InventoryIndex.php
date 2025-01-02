<?php

namespace App\Livewire\ManageInventory\InventoryIn;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Inventory [IN] List')]
class InventoryIndex extends Component {

    public $title = "Inventory [IN] List";
    public $text_subtitle = "Inventory [IN] List is used to display, manage, and monitor inventory data in the system";

    public function render() {
        return view('livewire.manage-inventory.inventory-in.inventory-index');
    }
}
