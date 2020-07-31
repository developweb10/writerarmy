<?php namespace Modules\Acl\Entities;

use App\User as BaseUser;
use Modules\Acl\Entities\Role;
use Illuminate\Database\Eloquent\Model;

class User extends BaseUser {

    // protected $fillable = [];

    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('slug', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function assign($role)
    {
        if(is_string($role))
        {
            return $this->roles()->save(
                Role::whereName($role)->firstOrFail()
            );
        }

        return $this->roles()->save($role);
    }
}