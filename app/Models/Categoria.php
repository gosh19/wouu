<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function tecnos($approved = null)
    {
        if ($approved == null) {
            return $this->hasMany('App\Models\TecnoData');
        }
        return $this->hasMany('App\Models\TecnoData')->where('approved', $approved)->get();
    }
    public function hasUser($user_id)
    {
        $data = \App\Models\TecnoData::where([['categoria_id',$this->id],['user_id',$user_id]])->first();

        return $data;
    }
}
