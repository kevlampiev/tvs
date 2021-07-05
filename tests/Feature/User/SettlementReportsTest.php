<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettlementReportsTest extends TestCase
{
    /**
     * Попытка зайти на сайт без авторизации.
     *
     * @return void
     */
    public function testVisitAsGuest()
    {
        //Заход без логина
        $response = $this->get(route('user.allSettlements'));
        $response->assertStatus(302)
        ->assertRedirect('login');
    }

    /**
     *Заход после авторизации на отчет по всем задолженностям в форме 1
     *
     *@return void
     */
    public function testVisitAuth1()
    {
        //Зайти как простой юзер
        $user = User::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('user.allSettlements'))
            ->assertStatus(200)
            ->assertSeeText('Задолженость по финансовым договорам')
            ->assertSeeText('Контрагент')
            ->assertSeeText('Всего');

    }

    /**
     *Заход после авторизации на отчет по всем задолженностям в форме 2
     *
     *@return void
     */
    public function testVisitAuth2()
    {
        //Зайти как простой юзер
        $user = User::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('user.allSettlements2'))
            ->assertStatus(200)
            ->assertSeeText('Задолженость по финансовым договорам')
            ->assertSeeText('Компания')
            ->assertSeeText('Всего');

    }


}
