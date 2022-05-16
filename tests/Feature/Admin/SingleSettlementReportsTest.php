<?php

namespace Tests\Feature\Admin;

use App\Models\Agreement;
use App\Models\User;
use Tests\TestCase;

class SingleSettlementReportsTest extends TestCase
{
    /**
     * Попытка зайти на сайт без авторизации.
     *
     * @return void
     */
    public function testVisitAsGuest()
    {
        //Заход без логина

        $response = $this->get(route('admin.agreementSettlements',
            ['id' => Agreement::query()->inRandomOrder()->first()->id]));
        $response->assertStatus(302);
    }

    /**
     * Попытка зайти на страницу с правами простого пользователя.
     *
     * @return void
     */
    public function testVisitAsUser()
    {
        //Заход без логина
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.agreementSettlements',
            ['id' => Agreement::query()->inRandomOrder()->first()->id]));
        $response->assertStatus(302)->assertRedirect(route('home'));
    }

    /**
     *Заход после авторизации на отчет по всем задолженностям в форме 1
     *
     * @return void
     */
    public function testVisitAuth()
    {
        //Зайти как простой юзер
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $agreement = Agreement::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.agreementSettlements',
                ['id' => $agreement->id]))
            ->assertStatus(200)
            ->assertSeeText('Договор №' . $agreement->agr_number)
            ->assertSeeText('Контрагент')
            ->assertSeeText('Всего')
            ->assertSeeText(number_format($agreement->payments->sum('amount'), 2));
    }

}
