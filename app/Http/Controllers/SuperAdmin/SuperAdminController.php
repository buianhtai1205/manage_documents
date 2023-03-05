<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SuperAdminController extends Controller
{
    public function  index(): Factory|View|Application
    {
        return view('super_admin.index');
    }

    public function  login()
    {
//        return view('super_admin.login');
    }
}

