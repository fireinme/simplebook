<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/13
 * Time: 13:25
 */

namespace App\Admin\Controllers;


use App\Topic;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('admin.topic.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.topic.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);
        Topic::create(request(['name']));

        return redirect()->route('topic.index');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topic.index');

    }

}