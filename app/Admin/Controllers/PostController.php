<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/4
 * Time: 20:10
 */

namespace App\admin\Controllers;


use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::withoutGlobalScope('avaiable')->where('status', 0)->orderBy('created_at', 'desc')->paginate(8);
        return view('admin.post.index', compact('posts'));

    }
}