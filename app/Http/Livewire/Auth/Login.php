<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember_me, $user;

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.login');
    }

    public function checkLogin()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            return redirect('customer');
            Session::set('user', Auth::user());
        } else {
            return redirect()->back()->with('error', 'Invalid credentials !');
        }
    }
}
