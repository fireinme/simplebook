<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/3
 * Time: 19:12
 */

namespace App\admin\Controllers;


use App\AdminUser;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.home.index', compact('user'));

    }

}