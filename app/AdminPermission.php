<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    //
    protected $table = 'admin_permissions';
    protected $fillable = ['name', 'description'];

    public function roles()
    {
        return $this->belongsToMany('App\AdminRole', 'admin_permission_role',
            'permission_id', 'role_id');
    }

}
