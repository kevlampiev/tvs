<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\TasksDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.tasks.projects',
            TasksDataservice::provideData());
    }

    public function create(Request $request)
    {
        $task = TasksDataservice::create($request);
        return view('Admin.tasks.project-edit ',
            TasksDataservice::provideEditor($task));
    }

    public function store(TaskRequest $request): \Illuminate\Http\RedirectResponse
    {
        TasksDataservice::store($request);
        return redirect()->route('admin.projects');
    }

    public function edit(Request $request, Task $task)
    {
        TasksDataservice::edit($request, $task);
        return view('Admin.tasks.project-edit',
            TasksDataservice::provideEditor($task));
    }

    public function update(TaskRequest $request, Task $task): \Illuminate\Http\RedirectResponse
    {
        TasksDataservice::update($request, $task);
        return redirect()->route('admin.projects');
    }


}
