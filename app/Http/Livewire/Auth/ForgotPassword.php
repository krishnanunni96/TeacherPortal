<?php

namespace App\Http\Livewire\Auth;

use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Models\User;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email, $details;

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('layouts.login');
    }

    public function submit()
    {
        $this->validate([
            'email' => 'required'
        ]);

        $user = User::where('email', $this->email)->get();
        $token = Str::random(60);
        
        $obj = new PasswordReset();
        $obj->email = $user[0]->email;
        $obj->token = $token;
        $obj->save();

        $url = url('reset-password/' . $token);

        $details = [
            'name' => $user[0]->name,
            'url' => $url
        ];

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Please check your mail !'
        ]);

        \Mail::to($obj->email)->send(new ResetPassword($details));
    }
}
