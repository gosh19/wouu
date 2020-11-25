<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Buscador extends Component
{
    public $search = '';
    public $result = [];

    public function mount()
    {
    }

    public function updated()
    {
        $this->result = \App\Models\Categoria::where('name','LIKE','%'.$this->search.'%')->get();
        if ($this->search == '') {
            $this->result = [];
        }
    }

    public function render()
    {
        return view('livewire.buscador');
    }
}
