<?php

namespace App\Livewire\ManageInventory\InventoryOut;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Create Inventory Out')]
class InventoryCreate extends Component {

    public $title = "Create Inventory Out";
    public $text_subtitle = "This page displays for create data inventory out.";

    public function render() {
        return view('livewire.manage-inventory.inventory-out.inventory-create');
    }
}
