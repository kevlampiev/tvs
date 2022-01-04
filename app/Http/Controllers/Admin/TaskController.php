<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query()
            ->where('parent_task_id','=', null)
            ->where('terminate_date','=', null)
            ->get();
        return view('Admin.tasks', ['tasks' => $tasks]);
    }
}
