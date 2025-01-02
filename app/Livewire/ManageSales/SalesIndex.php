<?php

namespace App\Livewire\ManageSales;

use App\Models\Sales;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Sales List')]
class SalesIndex extends Component
{

    public $title = "Sales List";
    public $text_subtitle = "Sales List is used to display, manage, and monitor sales data in the system";

    public function render()
    {
        $sales = Sales::with('user')
            ->get();
        return view('livewire.manage-sales.sales-index', compact('sales'));
    }
}
