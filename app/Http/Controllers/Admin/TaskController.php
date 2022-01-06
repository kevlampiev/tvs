<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\TasksDataservice;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.tasks.tasks',
            TasksDataservice::provideData());
    }
}
