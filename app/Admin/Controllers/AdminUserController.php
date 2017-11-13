<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/4
 * Time: 14:39
 */

namespace App\admin\Controllers;


use App\AdminRole;
use App\AdminUser;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    //用户管理首页
    public function index()
    {
        $admins = AdminUser::orderBy('id', 'asc')->get();
        return view('admin.user.index', compact('admins'));
    }

    //存贮新增的用户
    public function store()
    {
        //验证
        $this->validate(request(), [
            'name' => 'required|min:1|max:10|unique:admin_users',
            'password' => 'required|min:3|max:20',
        ]);

        $password = bcrypt(request('password'));
        $name = request('name');
        //插入数据
        AdminUser::create(compact('name', 'password'));
        return redirect()->route('admin.user');
    }

    //展示可选角色列表
    public function roleList(AdminUser $user)
    {
        $roles = AdminRole::all();
        $myRoles = $user->roles;
        return view('admin.user.role', compact('roles', 'myRoles', 'user'));
    }

    /*
     * 存储用户角色*/
    public function storeRoleStore(AdminUser $user)
    {
        //验证输入
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);
        //需要修改的用户
        $role_ids = request('roles');
        $roles = AdminRole::findMany($role_ids);
        //修改之前的用户的角色
        $myRoles = $user->roles;
        //比较差异，进行增加、删除
        $addRoles = $roles->diff($myRoles)->pluck('id');
        $delRoles = $myRoles->diff($roles)->pluck('id');
        $user->addRole($addRoles);
        $user->delRole($delRoles);

        return redirect()->route('admin.user');
    }
}