<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';


    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }


    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }
}
