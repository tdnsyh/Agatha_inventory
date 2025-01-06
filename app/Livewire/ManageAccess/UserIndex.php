<?php

namespace App\Livewire\ManageAccess;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\User;

#[Title('User List')]
class UserIndex extends Component
{

    public $title = "User List";
    public $text_subtitle = "User List is used to display, manage, and monitor user data in the system";

    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.manage-access.user-index', compact('users'));
    }
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'User successfully deleted.');
    }
}
