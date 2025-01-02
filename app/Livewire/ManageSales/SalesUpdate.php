<?php

namespace App\Livewire\ManageSales;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Update Sales')]
class SalesUpdate extends Component {

    public $title = "Update Sales";
    public $text_subtitle = "This page displays the sales data to be changed.";

    public function render() {
        return view('livewire.manage-sales.sales-update');
    }
}
