<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Production;
use App\Models\DetailProduction;

#[Title('Show Request Production')]
class InventoryRequestShow extends Component
{

    public $title = "Show Request Production";
    public $text_subtitle = "This page displays details of request production data.";

    public $production;
    public $details;

    public function mount($production)
    {
        $this->production = Production::find($production);
        $this->details = DetailProduction::where('production_id', $production)->get();
    }

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-show');
    }
}
