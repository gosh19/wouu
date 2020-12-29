<?php

namespace App\Http\Livewire\Work;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Postulation;
use App\Models\Conversation;
use App\Models\Message;

class Score extends Component
{
    public $postulation;

    public $score;
    public $comment;
    public $addComment = '';
    public $canScore;
    public $message = null;
    public $conversation;

    public function mount(Postulation $postulation)
    {   
        $this->postulation = $postulation;
        $this->score = $postulation->score;
        $this->comment = $postulation->comment;
        $this->canScore = Auth::id()==$postulation->work->user_id ? true:false;
        $this->conversation = Conversation::firstOrCreate(['cliente'=>$postulation->work->user_id,'tecnico'=>$postulation->user_id]);
    }

    public function setScore($i)
    {
        $this->postulation->score = $i;
        $this->postulation->save();

        $this->postulation->work->state = 'close';
        $this->postulation->work->save();

        $this->score = $i;
    }

    public function setComment()
    {
        $this->postulation->comment = $this->addComment;
        $this->postulation->save();

        $this->comment = $this->addComment;
    }

    public function sendMsg()
    {
        $message = new Message;

        $message->conversation_id = $this->conversation->id;
        $message->sender = Auth::id();
        $message->receiver = $this->postulation->user_id == Auth::id()?$this->postulation->work->user_id:$this->postulation->user_id;
        $message->msg = $this->message;

        $message->save();
        
        $this->message = null;

        $notification = \App\Models\NotificationWork::create([
            'sender'=> Auth::id(),
            'receiver'=> $this->postulation->user_id == Auth::id()?$this->postulation->work->user_id:$this->postulation->user_id,
            'work_id'=> $this->postulation->work->id,
            'type'=> 'msg',
        ]);
    }

    public function render()
    {
        return view('livewire.work.score');
    }
}
