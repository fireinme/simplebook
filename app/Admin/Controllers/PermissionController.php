<?php


namespace App\admin\Controllers;


use App\AdminPermission;
use App\AdminRole;

class PermissionController extends Controller
{
    public function index()
    {
        $pers = AdminPermission::all();
        return view('admin.permission.index', compact('pers'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        AdminPermission::create(request(['name', 'description']));

        return redirect()->route('per.index');
    }




}