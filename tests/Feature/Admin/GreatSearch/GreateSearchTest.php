<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\Manufacturer;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use App\Models\Vehicle;
use Tests\TestCase;

class GreatSearchTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.globalSearch',['globalSearch'=>' ']))
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
        //Не можем войти в список
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.globalSearch',['globalSearch'=>' ']))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Тестируем страницу поиска войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testList()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $url = route('admin.globalSearch').'?globalSearch=%25';
        $this->actingAs($user)->get($url)
            ->assertStatus(200)
        ->assertSeeText('Результаты поиска');
    }

    /**
     *Тестируем возможность поиска задачи
     *
     * @return void
     */
    public function testSearchTask()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $task = Task::query()->inRandomOrder()->first();
        $searchStr = str_replace(' ', '+', $task->subject);
        $url = route('admin.globalSearch').'?globalSearch='.$searchStr;
        $this->actingAs($user)->get($url)
            ->assertStatus(200)
        ->assertSeeText('Результаты поиска')
        ->assertSeeText($task->subject);
    }

    /**
     *Тестируем возможность поиска сообщения
     *
     * @return void
     */
    public function testSearchMessage()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $message = Message::query()->inRandomOrder()->first();
        $searchStr = str_replace(' ', '+', $message->subject);
        $url = route('admin.globalSearch').'?globalSearch='.$searchStr;
        $this->actingAs($user)->get($url)
            ->assertStatus(200)
        ->assertSeeText('Результаты поиска')
        ->assertSeeText($message->subject);
    }

    /**
     *Тестируем возможность поиска техники
     *
     * @return void
     */
    public function testSearchVehicle()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()->inRandomOrder()->first();
        $searchStr = str_replace(' ', '+', $vehicle->name);
        $url = route('admin.globalSearch').'?globalSearch='.$searchStr;
        $this->actingAs($user)->get($url)
            ->assertStatus(200)
        ->assertSeeText('Результаты поиска')
        ->assertSeeText($vehicle->name);
    }

    /**
     *Тестируем возможность поиска договора
     *
     * @return void
     */
    public function testSearchAgreement()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()->inRandomOrder()->first();
        $searchStr = str_replace(' ', '+', $agreement->agr_number);
        $url = route('admin.globalSearch').'?globalSearch='.$searchStr;
        $this->actingAs($user)->get($url)
            ->assertStatus(200)
        ->assertSeeText('Результаты поиска')
        ->assertSeeText($agreement->agr_number);
    }



}
