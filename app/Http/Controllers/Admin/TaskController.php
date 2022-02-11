<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\TasksDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\TaskRequest;
use App\Mail\NewTaskAppeared;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.tasks.projects',
            TasksDataservice::provideData());
    }

    public function viewUserTasks(Request $request, User $user)
    {

        return view('Admin.tasks.user-tasks', TasksDataservice::provideUserTasks($request, Auth::user()));
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
        return view('Admin.tasks.task-edit',
            TasksDataservice::provideEditor($task));
    }

    public function store(TaskRequest $request): \Illuminate\Http\RedirectResponse
    {
        $task = TasksDataservice::store($request);
        if($task->user_id != $task->task_performer_id) {
            Mail::to($task->performer->email)
                ->queue(new NewTaskAppeared($task));
        }
        $route = session('previous_url', route('admin.projects'));
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

    public function markAsRunning(Task $task)
    {
        TasksDataservice::markAsRunning($task);
        return redirect()->back();
    }

    public function setImportance(Task $task, string $importance)
    {
        TasksDataservice::setImportance($task, $importance);
        return redirect()->back();
    }

    public function viewTaskCard(Task $task)
    {
        return view('Admin.tasks.task-summary', ['task' => $task]);
    }

    public function addMessage(Request $request, Task $task)
    {
        $message = TasksDataservice::createTaskMessage($request, $task);
        return view('Admin.messages.message-edit',
            ['message' => $message, 'task' => $task]);
    }

    public function storeMessage(MessageRequest $request, Task $task)
    {
        TasksDataservice::storeTaskMessage($request);
        return redirect()->route('admin.taskCard', ['task' => $task]);
    }


}
