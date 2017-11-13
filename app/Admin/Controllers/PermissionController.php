<?php


namespace App\admin\Controllers;


use App\AdminPermission;

class PermissionController extends Controller
{
    //展示所有权限
    public function index()
    {
        $pers = AdminPermission::all();
        return view('admin.permission.index', compact('pers'));
    }

    //创建权限页面
    public function create()
    {
        return view('admin.permission.create');
    }

    //存贮新权限
    public function store()
    {
        //验证
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        AdminPermission::create(request(['name', 'description']));

        return redirect()->route('per.index');
    }


}