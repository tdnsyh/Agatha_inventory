<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;
use App\Models\DetailProduction;

#[Title('Show Production')]
class ProductionShow extends Component
{

    public $title = "Show Production";
    public $text_subtitle = "This page displays details of production data.";

    public $production;
    public $details;

    public function mount($id)
    {
        $this->production = Production::with(['productionRequest', 'user'])->findOrFail($id);
        $this->details = DetailProduction::with('product')
            ->where('production_id', $id)
            ->get();
    }

    public function render()
    {
        return view('livewire.manage-production.production-show');
    }
}
