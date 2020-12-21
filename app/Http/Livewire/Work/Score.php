<?php

namespace App\Http\Livewire\Work;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Postulation;

class Score extends Component
{
    public $postulation;

    public $score;
    public $comment;
    public $addComment = '';
    public $canScore;
    public $message = null;

    public function mount(Postulation $postulation)
    {   
        $this->postulation = $postulation;
        $this->score = $postulation->score;
        $this->comment = $postulation->comment;
        $this->canScore = Auth::id()==$postulation->work->user_id ? true:false;
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
        $this->comment = 32;
    }

    public function render()
    {
        return view('livewire.work.score');
    }
}
