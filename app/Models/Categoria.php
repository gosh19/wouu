<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function tecnos()
    {
        return $this->hasMany('App\Models\TecnoData');
    }
    public function hasUser($user_id)
    {
        $data = \App\Models\TecnoData::where([['categoria_id',$this->id],['user_id',$user_id]])->first();

        return $data;
    }
}
