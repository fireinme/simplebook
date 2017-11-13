<?php


namespace App\admin\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{


    public function login()
    {
        //验证登录信息
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required|min:3',
        ]);
        $admin = request(['name', 'password']);
        //判断登录信息是否符合
        if (!Auth::guard('admin')->attempt($admin)) {
            return back()->withErrors('登录信息不匹配');
        }
        return redirect()->route('admin.index');
    }

    //登出
    public function Logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.page');

    }
}