<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'admin_roles';
    protected $fillable = ['name', 'description'];

    //获取该角色下所有权限
    public function permissions()
    {
        return $this->belongsToMany('App\AdminPermissions', 'admin_permission_role',
            'Role_id', 'permission_id');
    }

    //添加权限
    public function addPermission($permission_id)
    {
        return $this->permissions()->attach($permission_id);

    }

    //删除权限
    public function delPermission($permission_id)
    {
        return $this->permissions()->detach($permission_id);
    }

    //是否有该权限
    public function hasPermission($permission)
    {
        return $this->permissions->contains($permission);

    }
}
