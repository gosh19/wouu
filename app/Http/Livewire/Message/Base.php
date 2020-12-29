<?php

namespace App\Http\Livewire\Message;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Base extends Component
{
    public $user;

    public function mount(\App\Models\User $user)
    {
        if (Auth::id() != $user->id) {
            return redirect('/');
        }
        $this->user = $user;

    }

    public function render()
    {
        return view('livewire.message.base');
    }
}
