<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register()
    {
        $this->validate(request(), [
            'name' => 'required|min:1|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        User::create(compact('name', 'email', 'password'));
        return redirect('login');
    }
}
