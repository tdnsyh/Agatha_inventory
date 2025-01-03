<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\DetailProduction;
use Illuminate\Support\Carbon;

#[Title('Production Report')]
class ProductionReport extends Component
{

    public $title = "Production Report";
    public $text_subtitle = "Generate Production Reports instantly";

    public $startDate;
    public $endDate;
    public $productionReport = [];

    public function generateReport()
    {
        $query = DetailProduction::with('product');

        if ($this->startDate && $this->endDate) {
            $this->validate([
                'startDate' => 'required|date',
                'endDate' => 'required|date|after_or_equal:startDate',
            ]);
            $query->whereBetween('created_at', [Carbon::parse($this->startDate), Carbon::parse($this->endDate)]);
        }

        $this->productionReport = $query->get();
    }

    public function mount()
    {
        $this->generateReport();
    }

    public function render()
    {
        return view('livewire.manage-production.production-report');
    }
}
