<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostsTopics;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TopicController extends Controller
{
    //进入专题页
    public function index(Topic $topic)
    {
        $posts = $topic->posts;
        $posts = Post::whereIn('id', $posts->pluck('id'))->withCount(['comments', 'zans'])->get();
        //$topic = Topic::withCount(['posts'])->find($topic->id)->get();
        $myPosts = Post::where('user_id', Auth::id())->TopicNotBy($topic->id)->get();

        return view('topic.show', compact('posts', 'topic', 'myPosts'));
    }

    public function submit(Topic $topic)
    {
        $this->validate(\request(), [
            'post_ids' => 'required|array'
        ]);
        $topic_id = $topic->id;
        $post_ids = \request('post_ids');

        foreach ($post_ids as $post_id) {
            PostsTopics::create(compact('post_id', 'topic_id'));
        }
        return back();
    }
}
