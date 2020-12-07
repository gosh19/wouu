<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','tecnico','cat_id','title','description'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function imgs()
    {
        return $this->hasMany('App\Models\WorkImage');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria','cat_id','id');
    }

    public function postulations()
    {
        return $this->hasMany('App\Models\Postulation');
    }

    public function postSelected()
    {
        return $this->hasMany('App\Models\Postulation')->where('state','selected')->first();
    }
}
