<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/9
 * Time: 17:15
 */

namespace App\Admin\Controllers;


use App\AdminPermission;
use App\AdminRole;

class RoleController extends Controller
{
    public function index()
    {
        $roles = AdminRole::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|unique:admin_roles',
            'description' => 'required|min:2'
        ]);
        AdminRole::create(request(['name', 'description']));

        return redirect()->route('role.index');

    }

    public function perList(AdminRole $role)
    {
        $pers = AdminPermission::all();
        $MyPers = $role->permissions;
        return view('admin.role.per_list', compact('role', 'MyPers', 'pers'));

    }

    public function perListStore(AdminRole $role)
    {
        $this->validate(request(), [
            'permissions' => 'required|array'
        ]);
        //修改后的角色权限
        $per_ids = request('permissions');
        $pers = AdminPermission::findMany($per_ids);
        //修改之前的角色权限
        $MyPers = $role->permissions;
        //新增的权限
        $addPers = $pers->diff($MyPers)->pluck('id');
        $delPers = $MyPers->diff($pers)->pluck('id');
        $role->addPermission($addPers);
        $role->delPermission($delPers);

        return redirect()->route('role.index');

    }

}