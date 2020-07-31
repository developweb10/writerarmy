<?php

namespace Modules\Acl\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    protected $table = 'permissions';

    protected $fillable = ['name', 'slug', 'description', 'model'];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
