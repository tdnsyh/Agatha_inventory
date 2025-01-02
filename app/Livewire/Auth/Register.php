<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

#[Layout('livewire.layouts.app-auth')]
class Register extends Component
{
    public $full_name, $username, $email, $password, $password_confirmation;
    public $error;

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    public function register()
    {
        $this->validate();

        try {
            $user = User::create([
                'full_name' => $this->full_name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            $this->error = 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage();
        }
    }


    public function render()
    {
        return view('livewire.auth.register');
    }
}
