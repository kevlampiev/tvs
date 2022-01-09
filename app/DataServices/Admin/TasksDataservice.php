<?php


namespace App\DataServices\Admin;


use App\Http\Requests\TaskRequest;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Task;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksDataservice
{
    public static function provideData(bool $hideClosedTasks=true): array
    {
        if ($hideClosedTasks) {
            $result = Task::query()
                ->where('parent_task_id','=', null)
                ->where('terminate_date', '=', null)
                ->get();
        } else {
            $result = Task::query()
                ->where('parent_task_id','=', null)
                ->get();;
        }
        return ['tasks' => $result, 'hideClosedTasks'=>$hideClosedTasks];
    }

    public static function provideEditor(Task $task): array
    {
        return ['task' => $task,
            'route' => ($task->id) ? 'admin.addTask' : 'admin.addTask',
            'users' => User::all(),
            'tasks' => Task::query()->where('parent_task_id','=', null)
                ->select(['id', 'subject'])->get(),
            'agreements' => Agreement::query()
                ->select(['id','name', 'agr_number','date_open'])->get(),
            'vehicles' => Vehicle::query()->select(['id', 'name', 'vin'])->get(),
            'companies' => Company::query()->select(['id', 'name'])->get(),
            'counterparties' => Counterparty::query()->select(['id', 'name'])->get(),
            'importances' => ['low' => 'Низкая', 'medium' => 'Обычная', 'high'=>'Высокая'],
            ];
    }

    public static function create(Request $request): Task
    {
        $task = new Task();
        $task->user_id = Auth::user()->id;
        $task->start_date = Carbon::now();
        $task->due_date = Carbon::now()->addDays(7);
        $task->importance = 'medium';
        if (!empty($request->old())) $task->fill($request->old());
        return $task;
    }

    public static function saveChanges(TaskRequest $request, Task $task)
    {
        $task->fill($request->all());
        if (!$task->user_id) $task->user_id = Auth::user()->id;
        if ($task->id) $task->updated_at = now();
        else $task->created_at = now();

        $task->save();
    }

    public static function store(TaskRequest $request)
    {
        try {
            $task = new Task();
            self::saveChanges($request, $task);
            session()->flash('message', 'Добавлена новая задача');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новую задачу');
        }

    }


    public static function edit(Request $request, Task $task)
    {

        if (!empty($request->old())) $task->fill($request->old());
//        $task->start_date = Carbon::parse($task->start_date)->toDateString();
//        $task->due_date = Carbon::parse($task->due_date)->toDateString();
    }

    public static function update(TaskRequest $request, Task $task)
    {
        try {
            self::saveChanges($request, $task);
            session()->flash('message', 'ЗАдача обновлена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить задачу');
        }
    }


}
