<?php

namespace App\Http\Livewire\Message;

use Livewire\Component;

class ConversationList extends Component
{
    public $user;
    public $converAsTecnico;
    public $converAsCliente;

    public function mount(\App\Models\User $user)
    {
        $this->user = $user;
        $this->converAsTecnico = $user->converAsTecnico;
        $this->converAsCliente = $user->converAsCliente;
    }

    public function selectChat(\App\Models\Conversation $conversation)
    {
        $this->emitTo('active-chat', 'setChat', $conversation);
    }

    public function render()
    {
        return view('livewire.message.conversation-list');
    }
}
