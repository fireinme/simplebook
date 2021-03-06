<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\topic;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        /*$posts = Post::orderBy('created_at', 'desc')->paginate(6);*/
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(6);
        return view('post.index', compact('posts', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required|min:20'
        ]);
        $user_id = Auth::id();
        $param = array_merge(request(['title', 'content']), compact('user_id'));
        Post::create($param);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //提前加载，不让页面查询数据库
        $post->load('comments');

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $this->authorize('update', $post);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required|min:20'
        ]);
        $post->update([
                'title' => $request->title,
                'content' => $request->input('content')
            ]
        );
        return route('posts.show', $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        //
        $this->authorize('delete', $post);
        $post->comments()->delete();
        $post->zans()->delete();
        $post->delete();
        return route('posts.show', $post);
    }

    /*
     * 图片上传方法
     * */


    public function comment()
    {
        $this->validate(request(), [
            'content' => 'required|min:3|max:100'
        ]);

        $user_id = Auth::id();
        $post_id = request('post_id');
        $content = request('content');

        Comment::create(compact('user_id', 'post_id', 'content'));
        return redirect()->back();
    }

    //点赞
    public function zan(Post $post)
    {
        $user_id = Auth::id();
        $post_id = $post->id;
        /*  $zan = new Zan();
          $zan->user_id = $user_id;
          $zan->post_id = $post_id;
          $zan->save();*/
        Zan::create(compact('user_id', 'post_id'));
        return back();
    }

    public function unZan(Post $post)
    {
        $user_id = Auth::id();
        $zan = $post->zan($user_id);
        $zan->delete();
        return back();
    }
}
