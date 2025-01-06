<?php

namespace App\Livewire\ManageAccess;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

#[Title('Create User')]
class UserCreate extends Component
{

    public $title = "Create User";
    public $text_subtitle = "This page displays for create data user.";

    public $full_name, $username, $email, $password, $password_confirmation;

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',  // validasi dengan aturan 'confirmed'
        'password_confirmation' => 'required|min:8', // konfirmasi password
    ];

    public function store()
    {
        $this->validate();

        User::create([
            'full_name' => $this->full_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'User successfully created.');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->full_name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }


    public function render()
    {
        return view('livewire.manage-access.user-create');
    }
}
