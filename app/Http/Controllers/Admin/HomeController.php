<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\TasksDataservice;
use App\DataServices\Admin\DashboardDataservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.index', DashboardDataservice::provideData());
    }
}
