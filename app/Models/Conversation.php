<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente','tecnico',
    ];

    public function getTecnico()
    {
        return $this->belongsTo('App\Models\User', 'tecnico', 'id');
    }

    public function getCliente()
    {
        return $this->belongsTo('App\Models\User', 'cliente', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
}
