<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    public function message_sender()
    {
        return $this->belongsTo(User::class, 'from_user');
    }
}
