<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;

#[Title('Update Production')]
class ProductionUpdate extends Component
{

    public $title = "Update Production";
    public $text_subtitle = "This page displays the production data to be changed.";

    public $production;
    public $production_date;
    public $production_status;
    public $note;
    public $details;

    public function mount($id)
    {

        $this->production = Production::with('details.product')->findOrFail($id);
        $this->production_date = $this->production->production_date;
        $this->production_status = $this->production->production_status;
        $this->note = $this->production->note;
        $this->details = $this->production->details;
    }

    public function updateProduction()
    {

        $this->validate([
            'production_date' => 'required|date',
            'production_status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $this->production->update([
            'production_date' => $this->production_date,
            'production_status' => $this->production_status,
            'note' => $this->note,
        ]);

        session()->flash('message', 'Production updated successfully!');
    }

    public function render()
    {
        return view('livewire.manage-production.production-update');
    }
}
