<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/9
 * Time: 17:15
 */

namespace App\Admin\Controllers;


use App\AdminRole;

class RoleController extends Controller
{
    public function index()
    {
        $roles = AdminRole::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');

    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|unique:admin_roles',
            'description' => 'required|min:2'
        ]);
        AdminRole::create(request(['name', 'description']));

        return redirect()->route('role.index');

    }

}