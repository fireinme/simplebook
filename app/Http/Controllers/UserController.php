<?php

namespace App\Http\Controllers;

use App\Fan;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(User $user)
    {
        $fans = $user->fans;
        $stars = $user->stars;
        $posts = $user->posts;
        return view('user.user', compact('fans', 'stars', 'posts', 'user'));
    }

    //关注用户
    public function star(User $star)
    {
        $fan_id = Auth::id();
        $star_id = $star->id;
        Fan::create(compact('fan_id', 'star_id'));
        return back();
    }

    //取消关注
    public function unstar(User $star)
    {
        $star = Auth::user()->star($star->id);
        $star->delete();
        return back();

    }
}
