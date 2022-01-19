<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\TasksDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.tasks.tasks',
            TasksDataservice::provideData());
    }

    public function viewUserTasks(Request $request, User $user)
    {
        return view ('Admin.tasks.user-tasks', TasksDataservice::provideUserTasks(Auth::user()));
    }

    public function create(Request $request)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        $task = TasksDataservice::create($request);
        return view('Admin.tasks.task-edit',
            TasksDataservice::provideEditor($task));
    }

    public function createSubTask(Request $request, Task $parentTask)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        $task = TasksDataservice::createSubTask($request, $parentTask);
//        dd($parentTask);
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

    public function markAsDone(Task $task)
    {
        TasksDataservice::markAsDone($task);
        return redirect()->back();
    }

    public function markAsCanceled(Task $task)
    {
        TasksDataservice::markAsCanceled($task);
        return redirect()->back();
    }


}
