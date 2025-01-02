<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;


#[Title('Dashboard')]
class Dashboard extends Component
{

    public $title = "Dashboard";
    public $text_subtitle = "Get an overview of the latest data and information";

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
