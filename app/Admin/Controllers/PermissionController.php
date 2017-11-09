<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/4
 * Time: 14:39
 */

namespace App\admin\Controllers;


use App\AdminPermission;
use App\AdminRole;
use App\AdminUser;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function index(AdminRole $role)
    {
        $pers = AdminPermission::all();
        return view('admin.permission.index', compact('pers'));
    }

    public function store()
    {
        //验证
        $this->validate(request(), [
            'name' => 'required|min:1|max:10|unique:admin_users',
            'password' => 'required|min:3|max:20',
        ]);


    }

    public function role()
    {
        $roles = AdminRole::all();
        return view('admin.user.role', compact('roles'));
    }

    public function storeRole()
    {
        $this->validate(request(), [
            'role[]' => 'required|array'
        ]);
        $user = Auth::guard('admin')->user();
        $user->addRole(request('role'));
        return back();
    }
}