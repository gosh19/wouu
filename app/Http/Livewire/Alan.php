<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Alan extends Component
{
    public $message = null;
    public $user;
    public $notifications = [];
    public $showNumber = 0;

    public function mount()
    {
        if (Auth::check()) {
            # code...
            $this->user = Auth::user();
            $this->setNotification();
            $this->showNumber = count($this->notifications)!=0 ? true:false;
        }else {
            $this->message= "Aun no haz iniciado sesion";
        }
    }
    
    public function setNotification()
    {
        if (count($this->notifications) != $this->user->notificationWork->count()) {
            # code...
            $this->notifications = $this->user->notificationWork;
            return ;
        }
    }



    public function showNotification()
    {
        $this->showNumber=!$this->showNumber;
    }

    public function render()
    {
        return view('livewire.alan');
    }
}
