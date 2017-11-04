<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/3
 * Time: 17:21
 */

namespace App\admin\Controllers;



use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{


    public function login()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required|min:3',
        ]);
        $admin = request(['name', 'password']);
        if (!Auth::guard('admin')->attempt($admin)) {
            return back()->withErrors('登录信息不匹配');
        } else {
            //Auth::guard('admins')->login();
            return redirect()->route('index');
        }

    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        //Auth::guard('admin')->logout();
        return redirect()->route('login');

    }
}