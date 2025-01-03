<?php

namespace App\Livewire\ManageSales;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Sales;

#[Title('Show Sales')]
class SalesShow extends Component
{

    public $title = "Show Sales";
    public $text_subtitle = "This page displays details of sales data.";

    public $sale;

    public function mount($id)
    {
        $this->sale = Sales::with(['user', 'details.product'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.manage-sales.sales-show');
    }
}
