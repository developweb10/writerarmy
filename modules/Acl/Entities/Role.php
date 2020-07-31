<?php

namespace Modules\Acl\Entities;

use Modules\Acl\Entities\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $table = 'roles';

    protected $fillable = ['name', 'slug', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        if(is_string($permission))
        {
            return $this->permissions->contains('slug', $permission);
        }

        return !! $permission->intersect($this->roles)->count();
    }
    public function assign(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

}