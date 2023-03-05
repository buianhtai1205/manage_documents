<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class SuperAdminController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' / ', $arr);
        \Illuminate\Support\Facades\View::share('title', $title);
    }

    public function  index(): Factory|View|Application
    {
        return view('super_admin.index');
    }

    public function  login()
    {
//        return view('super_admin.login');
    }
}

