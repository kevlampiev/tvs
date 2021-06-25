<?php

namespace Tests\Feature;

use App\Models\Agreement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response = $this->get(route('user.agreementSettlements',
            ['agreement' => Agreement::query()->inRandomOrder()->first()]));
        $response->assertStatus(302);
    }

    /**
     *Заход после авторизации на отчет по всем задолженностям в форме 1
     *
     *@return void
     */
    public function testVisitAuth()
    {
        //Зайти как простой юзер
        $user = User::query()->inRandomOrder()->first();
        $agreement = Agreement::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('user.agreementSettlements',
                ['agreement' => $agreement]))
            ->assertStatus(200)
            ->assertSeeText('Договор №'.$agreement->agr_number)
            ->assertSeeText('Контрагент')
            ->assertSeeText('Всего')
            ->assertSeeText(number_format($agreement->payments->sum('amount'),2));
    }

}
