<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    public $primaryKey = 'user_id';

    protected $fillable = [
        'user_id'
    ];
}
