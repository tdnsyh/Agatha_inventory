<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

#[Layout('livewire.layouts.app-auth')]
class Login extends Component
{
    public $email, $password;
    public $error;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        try {
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

                return redirect()->route('dashboard');
            } else {

                $this->error = 'Email atau password salah.';
            }
        } catch (\Exception $e) {
            $this->error = 'Terjadi kesalahan saat login: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
