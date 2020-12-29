<?php

namespace App\Http\Livewire\Message;

use Livewire\Component;

class ActiveChat extends Component
{
    public $message = '';
    public $conversation;

    protected $listeners = ['setChat'];

    public function mount()
    {
        $this->conversation = null;
    }

    public function setChat(\App\Models\Conversation $conversation)
    {
        $this->message = 'asdasd';
    }
    
    public function render()
    {
        return view('livewire.message.active-chat');
    }
}
