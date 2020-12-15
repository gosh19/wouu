<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TecnoData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'categoria_id', 'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function WorkDisponible()
    {
        $works = Work::where([['tecnico',null],['cat_id',$this->categoria_id]])->get();

        return $works;
    }
}
