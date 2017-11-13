<?php

namespace App\Admin\Controllers;


use App\Notice;

class NoticeController extends Controller
{
    //
    public function index()
    {
        $notices = Notice::all();

        return view('admin.notice.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notice.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'content' => 'required'
        ]);
        $notice = Notice::create(request(['title', 'content']));
        $this->dispatch(new \App\Jobs\sendNotice($notice));
        return redirect()->route('notice.index');
    }
}
