<?php

namespace App\Http\Livewire\Auth;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ConfirmResetPassword extends Component
{
    public $password, $password_confirmation, $email;

    public function mount($token)
    {
        $this->email = PasswordReset::where('token', $token)->value('email');
    }

    public function render()
    {
        return view('livewire.auth.confirm-reset-password')->layout('layouts.login');
    }

    public function submit()
    {                                                                              
        $this->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $user = User::where('email', $this->email)->get();
        $user[0]->password = Hash::make($this->password);
        $user[0]->save();

        $this->dispatchBrowserEvent('alert', [
            'alert' => 'success',
            'message' => 'Password changer successfully'
        ]);

        $this->redirect('/');
    }
}
