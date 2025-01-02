<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Priority Analysis')]
class PriorityAnalysis extends Component {

    public $title = "Priority Analysis";
    public $text_subtitle = "Product Priority Analysis Makes it Easier for You to Make Decisions";

    public function render() {
        return view('livewire.priority-analysis');
    }
}
