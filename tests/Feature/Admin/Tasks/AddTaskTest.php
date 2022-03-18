<?php

namespace Tests\Feature\Admin\Tasks;


use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class AddTaskTest extends TestCase
{

    private function createTask(User $user = null): array
    {
//        $user = $user??User::query()->inRandomOrder()->first();
//        $task = new Task();
//        $task->fill(['user_id' => $user,
//            'task_performer_id' => $user,
//            'start_date' => Carbon::now()->toDateString(),
//            'due_date' => Carbon::now()->addDay()->toDateString(),
//            'subject' => 'Задача добавлена тестом',
//            'description' => 'Задача добавлена тестом',
//
//            ]);
//        return $task;

        $user = $user ?? User::query()->inRandomOrder()->first();
        return ['user_id' => $user,
            'task_performer_id' => $user,
            'start_date' => Carbon::now()->toDateString(),
            'due_date' => Carbon::now()->addDay()->toDateString(),
            'subject' => 'Задача добавлена тестом',
            'description' => 'Задача добавлена тестом',

        ];
    }


    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnAuthorized()
    {
        $task = Task::query()->where('terminate_date', '=', null)->inRandomOrder()->first();
        $this->get(route('admin.addSubTask', ['parentTask'=>$task]))
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
        $task = Task::query()->where('terminate_date', '=', null)->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addSubTask', ['parentTask'=>$task]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }


    /**
     * Тестируем форму добавления задачи
     * @return void
     */
    public function test_indexPage()
    {
        $user = User::query()->where('role', '<>','user')->inRandomOrder()->first();
        $task = Task::query()->where('terminate_date', '=', null)->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addSubTask', ['parentTask'=>$task]))
            ->assertStatus(200)
//            ->assertSeeText('Задачи')
            ->assertSeeText('Добавить новую задачу')
            ->assertSeeText('Родительская задача')
            ->assertSeeText('Дополнительная информация')
            ->assertSeeText('Дополнительные поля')
            ->assertSeeText('Исполнитель задачи')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');

    }

    /**
     * Тестируем невозможность добавть завипь неавторизованному пользователю
     * @return void
     */
    public function testPostUnauthorized()
    {
        $response = $this->post(route('admin.addTask', ['task' => $this->createTask()]));
        $response->assertStatus(302)->assertRedirect('login');

    }

    /**
     * Тестируем добавление задачи авторизованному пользователю
     * @return void
     */
    public function testPost()
    {
        $user = User::query()->where('role', 'manager')->orWhere('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->post(route('admin.addTask', $this->createTask($user)));
        $response->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
//            ->assertSessionHas(['message', 'Добавлена новая задача']);

    }

}
