<?php


namespace App\DataServices\Admin;


use App\Http\Requests\MessageRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksDataservice
{
    public static function provideData(bool $hideClosedTasks = true): array
    {
        if ($hideClosedTasks) {
            $result = Task::query()
                ->where('parent_task_id', '=', null)
                ->where('terminate_date', '=', null)
                ->get();
        } else {
            $result = Task::query()
                ->where('parent_task_id', '=', null)
                ->get();;
        }
        return ['tasks' => $result, 'hideClosedTasks' => $hideClosedTasks];
    }

    public static function provideUserTasks(Request $request, User $user): array
    {
        $filter = ($request->get('searchStr')) ?? '';
        $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
        $userAssignments = Task::query()
            ->where('task_performer_id', '=', $user->id)
            ->where('terminate_date', '=', null)
            ->where('parent_task_id', '<>', null)
            ->where('subject', 'like', $searchStr)
            ->orderBy('user_id')
            ->orderBy('due_date')
            ->get();
        $assignedByUser = Task::query()
            ->where('user_id', '=', $user->id)
            ->where('task_performer_id', '<>', $user->id)
            ->where('terminate_date', '=', null)
            ->where('parent_task_id', '<>', null)
            ->where('subject', 'like', $searchStr)
            ->orderBy('task_performer_id')
            ->orderBy('due_date')
            ->get();

        return [
            'userAssignments' => $userAssignments,
            'assignedByUser' => $assignedByUser,
            'filter' => $filter
        ];

    }


    public static function provideEditor(Task $task): array
    {
        return ['task' => $task,
            'route' => ($task->id) ? 'admin.addTask' : 'admin.addTask',
            'users' => User::all(),
            'tasks' => Task::query()->select(['id', 'subject'])->get(),
            'agreements' => Agreement::query()
                ->select(['id', 'name', 'agr_number', 'date_open'])->get(),
            'vehicles' => Vehicle::query()->select(['id', 'name', 'vin', 'bort_number'])->get(),
            'companies' => Company::query()->select(['id', 'name'])->get(),
            'counterparties' => Counterparty::query()->select(['id', 'name'])->get(),
            'importances' => ['low' => 'Низкая', 'medium' => 'Обычная', 'high' => 'Высокая'],
        ];
    }

    private static function createNewTask(array $params): Task
    {
        $task = new Task();
        $task->fill($params);
        $task->user_id = Auth::user()->id;
        $task->start_date = Carbon::now();
        $task->due_date = Carbon::now()->addDays(7);
        $task->importance = 'medium';
        return $task;

    }

    public static function create(Request $request): Task
    {
        $task = self::createNewTask([]);
        if (!empty($request->old())) $task->fill($request->old());
        return $task;
    }

    public static function createSubTask(Request $request, Task $parentTask): Task
    {
        $task = self::createNewTask(['parent_task_id' => $parentTask->id]);
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
            session()->flash('message', 'Задача обновлена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить задачу');
        }
    }

    //Пометить задачу и все ее дочерние задачи, как выполненную
    public static function markAsDone(Task $task)
    {
        try {
            DB::statement('CALL po_mark_task_as_done(?)', [$task->id]);
            session()->flash('message', 'Задача помечена как выполненная');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось завершить задачу');
        }
    }

    //Пометить задачу и все ее дочерние задачи, как отмененную
    public static function markAsCanceled(Task $task)
    {
        try {
            DB::statement('CALL po_mark_task_as_canceled(?)', [$task->id]);
            session()->flash('message', 'Задача отменена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось отменить задачу');
        }
    }

    //Пометить задачу и все ее дочерние задачи, как отмененную
    public static function markAsRunning(Task $task)
    {
        try {
            $task->terminate_date = null;
            $task->terminate_status = null;
            $task->save();
            session()->flash('message', 'Задача восстановлена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось восстановить задачу');
        }
    }


    public static function createTaskMessage(Request $request, Task $task): Message
    {
        $message = new Message();
        $message->fill(['user_id' => Auth::user()->id,
            'task_id' => $task->id]);
        if (!empty($request->old())) $message->fill($request->old());
        return $message;
    }

    public static function storeTaskMessage(MessageRequest $request)
    {
        try {
            $message = new Message();
            $message->fill($request->all());
//            dd($message);
            if (!$message->user_id) $message->user_id = Auth::user()->id;
            $message->created_at = now();
            $message->save();
            session()->flash('message', 'Добавлено новое сообщение');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить сообщение');
        }
    }

}
