<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender', 'receiver', 'work_id', 'type'
    ];

    public function getSender()
    {
        return $this->belongsTo('App\Models\User', 'sender', 'id');
    }

    public function getReceiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver', 'id');
    }

    public function work()
    {
        return $this->belongsTo('App\Models\Work');
    }
}
