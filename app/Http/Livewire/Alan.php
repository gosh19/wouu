<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Alan extends Component
{
    public $message = null;
    public $user;
    public $notificationsChecked = [];
    public $notificationsUnChecked = [];
    public $showNumber = false;
    public $showNotifications = false;

    public function mount()
    {
        if (Auth::check()) {
            # code...
            $this->user = Auth::user();
            $this->notificationsChecked = \App\Models\NotificationWork::where([['receiver',Auth::id()],['seen',1]])->orderBy('id','desc')->take(5)->get();
            $this->notificationsUnChecked = \App\Models\NotificationWork::where([['receiver',Auth::id()],['seen',0]])->get();

            if ($this->notificationsUnChecked!=null) {
                if (count($this->notificationsUnChecked)!=0) {
                    $this->showNumber = true;
                    $this->showNotification = true;
                    foreach ($this->notificationsUnChecked as $key => $noti) {
                        $noti->seen = 1;
                        $noti->save();
                    }
                }
            }
        }else {
            $this->message= "Aun no haz iniciado sesion";
        }
    }
    
    public function setNotification()
    {

        if (count($this->notificationsUnChecked) != \App\Models\NotificationWork::where([['receiver',Auth::id()],['seen',0]])->count()) {
            $this->notificationsUnChecked = \App\Models\NotificationWork::where([['receiver',Auth::id()],['seen',0]])->get();
        }
    }
    


    public function showNotification()
    {
        $this->showNotifications=!$this->showNotifications;
    }

    public function render()
    {
        return view('livewire.alan');
    }
}
