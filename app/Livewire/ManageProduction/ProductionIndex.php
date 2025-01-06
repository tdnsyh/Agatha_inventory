<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;

#[Title('Production List')]
class ProductionIndex extends Component
{

    public $title = "Production List";
    public $text_subtitle = "Production List is used to display, manage, and monitor production data in the system";

    public function render()
    {
        $productions = Production::with('user')
            ->where('status', '!=', ' waiting for response')
            ->orderByRaw("status != 'complete' desc")
            ->orderBy('request_date', 'desc')
            ->get();

        return view('livewire.manage-production.production-index', compact('productions'));
    }
}
