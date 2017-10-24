<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        $user_detail = \request(['email', 'password']);
        if (Auth::attempt($user_detail, request('is_remember'))) {
            return redirect('posts');
        };
        return redirect()->back()->withErrors('邮箱密码不匹配');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');

    }
}
