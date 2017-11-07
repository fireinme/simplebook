<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/4
 * Time: 14:39
 */

namespace App\admin\Controllers;


use App\AdminUser;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = AdminUser::orderBy('id', 'asc')->get();
        return view('admin.user.index', compact('admins'));
    }

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
}