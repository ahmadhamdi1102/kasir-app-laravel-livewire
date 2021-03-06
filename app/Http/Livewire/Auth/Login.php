<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => '',
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function submit(){
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required'
        ]);

        $user = User::where([
            "email" => $this->form["email"]
        ])->get();

        if(count($user) == 1 && Auth::attempt($this->form)){
            redirect()->route('home');
        }else{
            session()->flash('error', 'Your credentials does not match. Please try again later!');
        }
    }
}
