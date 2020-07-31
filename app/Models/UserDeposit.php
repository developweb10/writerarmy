<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeposit extends Model
{
    protected $table = 'user_deposits';
    protected $fillable = ['id', 'userId', 'transaction_date', 'amount', 'transaction_type'];
}
