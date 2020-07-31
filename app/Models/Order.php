<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){

        return $this->belongsTo(User::class, 'order_placed_by');
    }

    public function packages()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

}
