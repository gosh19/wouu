<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class FormWork extends Component
{
    public $categorias;

    public $title;
    public $description;
    public $cat;
    public $arch1 = null;
    public $arch2 = null;
    public $arch3 = null;
    public $formImg = false;
    public $loadingWork = false;
    public $loadingDone = false;

    use WithFileUploads;

    public function mount()
    {
        $this->categorias = \App\Models\Categoria::all();

        $this->title = "";
        $this->description = "";
        $this->cat = null;

    }

    public function cargarWork()
    {
        $this->formImg = false;
        $this->loadingWork = true;

        $files = array();
        $categoria = json_decode($this->cat, true);
        $user = Auth::user()->name;

        if ($this->arch1 != null) {
            $name = $this->arch1->store('/'.$user.'/'.$categoria['name'],'public');
            $files[] = '/storage/'.$name;
        }
        if ($this->arch2 != null) {
            $name = $this->arch2->store('/'.$user.'/'.$categoria['name'],'public');
            $files[] = '/storage/'.$name;
        }
        if ($this->arch3 != null) {
            $name = $this->arch3->store('/'.$user.'/'.$categoria['name'],'public');
            $files[] = '/storage/'.$name;
        }

        $work = new \App\Models\Work;
        
        $work->user_id = Auth::id();
        $work->cat_id = $categoria['id'];
        $work->title = $this->title;
        $work->description = $this->description;

        $work->save();

        foreach ($files as $key => $arch) {
            $workImg = new \App\Models\WorkImage;

            $workImg->work_id = $work->id;
            $workImg->url = $arch;

            $workImg->save();
        
        }

        $this->loadingWork = false;
        $this->loadingDone = true;

    }

    public function render()
    {
        return view('livewire.form-work');
    }
}
