<?php

namespace Tests\Feature\Admin\Tasks;


use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskCardTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnAuthorized()
    {
        $task = Task::query()->inRandomOrder()->first();

        $this->get(route('admin.taskCard', ['task' => $task]))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     *Тестируем невозможность входа простым юзером
     *
     * @return void
     */
    public function testAsUser()
    {
        $task = Task::query()->inRandomOrder()->first();
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.taskCard', ['task' => $task]))
            ->assertStatus(302)
            ->assertRedirect('/');
    }


    /**
     * Тестируем общий список задач
     * @return void
     */
    public function testProjectCard()
    {
        $task = Task::query()->where('parent_task_id','=', null)->inRandomOrder()->first();
        $user = User::query()->where('role', 'manager')->orWhere('role', 'admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.taskCard', ['task' => $task]));
        $response->assertStatus(200)
            ->assertSeeText('Карточка Проекта')
            ->assertSeeText('Основная информация')
            ->assertSeeText('Дочерние задачи')
            ->assertSeeText($task->subject)
            ->assertSeeText($task->description)
            ->assertSeeText($task->user->name)
            ->assertSeeText('Новая дочерняя задача')
            ->assertSeeText('Сообщения')
            ->assertSeeText('Новое сообщение');

        $subTask = $task->subtasks->where('terminate_date', '=', null)->first();
        if($subTask) {
            $response->assertSeeText($subTask->subject);
        }

        $message = $task->messages->first();
        if ($message) {
            $response->assertSeeText($message->description);
        }
    }

}
