<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\TasksDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.tasks.tasks',
            TasksDataservice::provideData());
    }

    public function create(Request $request)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        $task = TasksDataservice::create($request);
        return view('Admin.tasks.task-edit',
            TasksDataservice::provideEditor($task));
    }

    public function store(TaskRequest $request): \Illuminate\Http\RedirectResponse
    {
        TasksDataservice::store($request);
        $route = session('previous_url', route('admin.tasks'));
        return redirect()->to($route);
    }

    public function edit(Request $request, Task $task)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        TasksDataservice::edit($request, $task);
        return view('Admin.tasks.task-edit',
            TasksDataservice::provideEditor($task));
    }

    public function update(TaskRequest $request, Task $task): \Illuminate\Http\RedirectResponse
    {
        TasksDataservice::update($request, $task);
        $route = session('previous_url');
        return redirect()->to($route);
    }


}
