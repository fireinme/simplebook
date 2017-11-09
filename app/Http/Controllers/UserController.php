<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Fan;
use App\Post;
use App\User;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index(User $user)
    {
        $user = User::withCount(['posts', 'fans', 'stars'])->find($user->id);

        $fans = $user->fans;
        $fans = User::whereIn('id', $fans->pluck('id'))->withCount(['posts', 'fans', 'stars'])->get();

        $stars = $user->stars;
        $stars = User::whereIn('id', $stars->pluck('id'))->withCount(['posts', 'fans', 'stars'])->get();

        $posts = $user->posts;

        return view('user.user', compact('fans', 'stars', 'posts', 'user'));
    }

    //关注用户
    public function star(User $star)
    {
        $fan_id = Auth::id();
        $star_id = $star->id;
        Fan::create(compact('fan_id', 'star_id'));
        return [
            'error' => 0,
            'msg' => ''
        ];
    }

    //取消关注
    public function unstar(User $star)
    {
        $star = Auth::user()->star($star->id);
        $star->delete();
        return [
            'error' => 0,
            'msg' => ''
        ];

    }

    //个人设置页
    public function setView(User $user)
    {

        return view('user.setting', compact('user'));
    }

    //保存个人设置
    public function setting()
    {

        return redirect()->route('posts.index');
    }

    public function role(AdminUser $user)
    {
        return view('admin.user.role', compact('user'));

    }
    //保存角色
    public function storeRole()
    {

    }


}
