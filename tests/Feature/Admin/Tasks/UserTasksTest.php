<?php

namespace Tests\Feature\Admin\Tasks;


use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class UserTasksTest extends TestCase
{

    /**
     * Форма просмотра всех задач пользователя видна
     * @return void
     */
    public function test_indexPage()
    {
        $user = Task::query()
            ->where('terminate_date','=', null)
            ->inRandomOrder()->first()->user;
        $this->actingAs($user)->get(route('admin.userTasks', ['user'=>$user]))
            ->assertStatus(200)
            ->assertSeeText('Мои задачи')
            ->assertSeeText('Задачи, поставленные передо мной')
            ->assertSeeText('Задачи, поставленные мною другим сотрудникам')
            ->assertSeeText('Арт')
            ->assertSeeText('Формулировка')
            ->assertSeeText('Срок исполнения')
            ->assertSeeText($user->name);

    }

    /**
     * В форме "Мои задачи" присутствуют открытые задачи
     * @return void
     */
    public function testSeeOpenedTask()
    {
        $task = Task::query()
            ->where('terminate_date','=', null)
            ->where('hidden_task','=', false)
            ->inRandomOrder()->first();
        $this->actingAs($task->user)->get(route('admin.userTasks', ['user'=>$task->user]))
            ->assertStatus(200)
            ->assertSeeText('Мои задачи')
            ->assertSeeText('Задачи, поставленные передо мной')
            ->assertSeeText('Задачи, поставленные мною другим сотрудникам')
            ->assertSeeText('Арт')
            ->assertSeeText('Формулировка')
            ->assertSeeText('Срок исполнения')
            ->assertSeeText($task->user->name)
        ->assertSeeText($task->subject);
    }

    /**
     * В форме "Мои задачи" отсутствуют скрытые задачи (неоторбражаемые)
     * @return void
     */
    public function testDontSeeHiddenTask()
    {
        $task = Task::query()
            ->where('terminate_date','=', null)
            ->where('hidden_task','=', true)

            ->inRandomOrder()->first();
        $this->actingAs($task->user)->get(route('admin.userTasks', ['user'=>$task->user]))
            ->assertStatus(200)
            ->assertSeeText('Мои задачи')
            ->assertSeeText('Задачи, поставленные передо мной')
            ->assertSeeText('Задачи, поставленные мною другим сотрудникам')
            ->assertSeeText('Арт')
            ->assertSeeText('Формулировка')
            ->assertSeeText('Срок исполнения')
        ->assertDontSeeText('#'.$task->id);
    }

    /**
     * В форме "Мои задачи" отсутствуют закрытые задачи
     * @return void
     */
    public function testDontSeeClosedTask()
    {
        $task = Task::query()
            ->where('terminate_date','<>', null)
            ->inRandomOrder()->first();
        $this->actingAs($task->user)->get(route('admin.userTasks', ['user'=>$task->user]))
            ->assertStatus(200)
            ->assertSeeText('Мои задачи')
            ->assertSeeText('Задачи, поставленные передо мной')
            ->assertSeeText('Задачи, поставленные мною другим сотрудникам')
            ->assertSeeText('Арт')
            ->assertSeeText('Формулировка')
            ->assertSeeText('Срок исполнения')
        ->assertDontSeeText('#'.$task->id);
    }

    /**
     * Не могу посмотреть карточку задачи, если я простой юзер
     * @return void
     */
    public function testCantSeeUserTasksForUsers()
    {
        $user = User::query()->where('role','=', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.userTasks', ['user'=>$user]))
            ->assertStatus(302);
    }


}
