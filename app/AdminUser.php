<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class AdminUser extends Authenticatable
{
    //
    protected $rememberTokenName = '';
    protected $fillable = ['name', 'password'];

    public function roles()
    {
        return $this->belongsToMany('App\AdminRole', 'admin_role_user', 'user_id', 'role_id');
    }


    public function addRole($role_id)
    {
        return $this->roles()->attach($role_id);
    }

    public function delRole($role_id)
    {
        return $this->roles()->detach($role_id);
    }

    public function hasRole($roles)
    {
        return !!$roles->intersect($this->roles)->count();
    }

    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }

}


