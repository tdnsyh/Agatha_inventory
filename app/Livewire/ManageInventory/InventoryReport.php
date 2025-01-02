<?php

namespace App\Livewire\ManageInventory;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Inventory Report')]
class InventoryReport extends Component {

    public $title = "Inventory Report";
    public $text_subtitle = "Generate Inventory Reports instantly";

    public function render() {
        return view('livewire.manage-inventory.inventory-report');
    }
}
