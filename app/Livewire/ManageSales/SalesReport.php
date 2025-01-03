<?php

namespace App\Livewire\ManageSales;

use App\Models\Sales;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Sales Report')]
class SalesReport extends Component
{

    public $title = "Sales Report";
    public $text_subtitle = "Generate Sales Reports instantly";

    public $start_date;
    public $end_date;
    public $sales = [];

    protected $rules = [
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ];

    public function mount()
    {
        $this->sales = $this->getSales();
    }

    public function render()
    {
        return view('livewire.manage-sales.sales-report');
    }

    public function generateReport()
    {
        $this->sales = $this->getSales();
    }

    public function getSales()
    {
        $query = Sales::query();

        if ($this->start_date) {
            $query->where('transaction_date', '>=', Carbon::parse($this->start_date));
        }

        if ($this->end_date) {
            $query->where('transaction_date', '<=', Carbon::parse($this->end_date));
        }

        return $query->with('details.product')->get();
    }
}
