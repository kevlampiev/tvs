<?php

namespace tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RootTest extends TestCase
{
    /**
     * Попытка зайти на сайт без авторизации.
     *
     * @return void
     */
    public function testVisitAsGuest()
    {
        //Заход без логина
        $response = $this->get('/');
        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     *Заход в качестыве простого пользователя
     *
     * @return void
     */
    public function testVisitAsUser()
    {
        //Зайти как простой юзер
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $response = $this->actingAs($user)
            ->get('/')
            ->assertStatus(200)
            ->assertSeeText('Состояние расчетов')
            ->assertSee('chart') //есть график
            ->assertDontSeeText('Панель управления');
    }

    /**
     *Заход в качестве менеджера
     *
     * @return void
     */
    public function testVisitAsManager()
    {
        //Зайти как простой юзер
        $user = User::query()->where('role', 'manager')->inRandomOrder()->first();
        $response = $this->actingAs($user)
            ->get('/')
            ->assertStatus(200)
            ->assertSeeText('Состояние расчетов')
            ->assertSee('chart') //есть график
            ->assertSeeText('Панель управления');
    }


    /**
     *Заход в качестыве простого администратора
     *
     * @return void
     */
    public function testVisitAsAdmin()
    {
        //Зайти как простой юзер
        $user = User::query()->where('role', 'admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)
            ->get('/')
            ->assertStatus(200)
            ->assertSeeText('Состояние расчетов')
            ->assertSee('chart') //есть график
            ->assertSeeText('Панель управления');
    }

}
