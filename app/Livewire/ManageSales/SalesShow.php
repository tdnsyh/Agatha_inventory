<?php

namespace App\Livewire\ManageSales;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Show Sales')]
class SalesShow extends Component {

    public $title = "Show Sales";
    public $text_subtitle = "This page displays details of sales data.";

    public function render() {
        return view('livewire.manage-sales.sales-show');
    }
}
