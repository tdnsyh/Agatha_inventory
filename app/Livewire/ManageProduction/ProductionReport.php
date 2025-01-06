<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\DetailProduction;
use Illuminate\Support\Carbon;
use App\Models\Production;

#[Title('Production Report')]
class ProductionReport extends Component
{

    public $title = "Production Report";
    public $text_subtitle = "Generate Production Reports instantly";

    public $status;
    public $start_date;
    public $end_date;
    public $productions;

    public function mount()
    {

        $this->status = '';
        $this->start_date = Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = Carbon::now()->endOfMonth()->toDateString();

        $this->loadProductions();
    }

    public function loadProductions()
    {
        $query = Production::query();

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->start_date && $this->end_date) {
            $query->whereBetween('production_date', [$this->start_date, $this->end_date]);
        }

        $productions = $query->orderBy('production_date', 'desc')->get();

        $this->productions = $productions->map(function ($production) {
            $production->details = DetailProduction::where('production_id', $production->id)->get();
            return $production;
        });
    }

    public function render()
    {
        return view('livewire.manage-production.production-report');
    }
}
