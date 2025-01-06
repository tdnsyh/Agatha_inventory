<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ProductionRequest;

#[Title('Create Production')]
class ProductionCreate extends Component
{

    public $title = "Create Production";
    public $text_subtitle = "This page displays for create data production.";

    public function render()
    {
        return view('livewire.manage-production.production-create');
    }
}
