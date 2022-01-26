<?php

namespace Tests\Feature\Admin\Tasks;


use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class AllTheTasksTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnAuthorized()
    {
        $this->get(route('admin.tasks'))
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
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.tasks'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }


    /**
     * Тестируем общий список задач
     * @return void
     */
    public function test_indexPage()
    {
        $user = User::query()->where('role', 'manager')->orWhere('role', 'admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.tasks'));
        $response->assertStatus(200)
            ->assertSeeText('Задачи')
            ->assertSeeText('Добавить новую задачу');
        $task = Task::query()->where('parent_task_id', '=', null)
            ->where('terminate_date', '=', null)->inRandomOrder()->first();

        if ($task) {
            $response->assertSeeText('Управление задачей')
                ->assertSeeText($task->subject);
        } else {
            $response->assertDontSeeText('Управление задачей')
                ->assertSeeText('Нет записей');
        }
    }

}
