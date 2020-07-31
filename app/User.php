<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class User extends Authenticatable implements BillableContract
{

    use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];


    protected $fillable = [
        'name', 'email', 'password', 'phone', 'company_name', 'confirmation_code', 'confirmed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Models\UserProfile::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Models\Skill::class, 'skill_user');
    }
}
