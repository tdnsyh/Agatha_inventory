<?php

namespace App\Livewire\ManageAccess;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

#[Title('Update User')]
class UserUpdate extends Component
{

    public $title = "Update User";
    public $text_subtitle = "This page displays the profile of user data.";

    public $userId, $full_name, $username, $email, $user, $password, $password_confirmation;

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . '{userId}',
        'email' => 'required|email|unique:users,email,' . '{userId}',
        'password' => 'nullable|min:8|confirmed',
        'password_confirmation' => 'nullable|min:8',
    ];

    public function mount($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->user = User::findOrFail($userId);
        $this->full_name = $user->full_name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'full_name' => $this->full_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        session()->flash('message', 'User successfully updated.');
    }

    public function render()
    {
        return view('livewire.manage-access.user-update');
    }
}
