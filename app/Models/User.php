<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'admin'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userData()
    {
        return $this->hasOne('App\Models\UserData');
    }

    public function tecnoDatas($approved = null)
    {
        if ($approved == null) {
            return $this->hasMany('App\Models\TecnoData');
        }

        return $this->hasMany('App\Models\TecnoData')->where('approved',$approved)->get();
    }
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact')->orderBy('id','desc');
    }

    public function worksPedidos()
    {
        return $this->hasMany('App\Models\Work');
    }

    public function workDisponible()
    {
        $works=['works'=>[],'cant'=>0];
        foreach ($this->tecnoDatas(1) as $key => $tecno) {
            foreach ($tecno->WorkDisponible() as $key => $work) {
                similar_text($work->userData()->city, $this->userData->city, $porcentaje);
                if ($porcentaje > 65) {
                    # code...
                    $works['works'][]=$work;
                    $works['cant'] ++;
                }
            }
        }

        return $works;
    }

    public function postulations($case = null)
    {
        if ($case == null) {

            return $this->hasMany('App\Models\Postulation');
        }

        return $this->hasMany('App\Models\Postulation')->where('state','selected')->get();
    }
}
