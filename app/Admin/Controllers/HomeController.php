<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/3
 * Time: 19:12
 */

namespace App\admin\Controllers;


use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function index()
    {
        return view('admin.home.index');
    }

}