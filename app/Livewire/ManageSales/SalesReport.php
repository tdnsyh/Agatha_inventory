<?php

namespace App\Livewire\ManageSales;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Sales Report')]
class SalesReport extends Component {

    public $title = "Sales Report";
    public $text_subtitle = "Generate Sales Reports instantly";

    public function render() {
        return view('livewire.manage-sales.sales-report');
    }
}
