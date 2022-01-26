<?php

namespace Tests\Feature\User;

use App\Models\Agreement;
use App\Models\User;
use Tests\TestCase;

class UpcomingPaymentsTest extends TestCase
{
    /**
     * Попытка посетить страницу без авторизации.
     *
     * @return void
     */
    public function testVisitAsGuest()
    {
        //Заход без логина
        $response = $this->get(route('user.nearestPayments'));
        $response->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     *Заход после авторизации
     *
     * @return void
     */
    public function testVisitAuth1()
    {
        $user = User::query()->inRandomOrder()->first();
        //берем незакрытый договор
        $agreement = Agreement::query()
            ->where('real_date_close', '=', null)
            ->inRandomOrder()
            ->first();
        //берем закрытый договор
        $agreementClosed = Agreement::query()
            ->whereNotNull('real_date_close')
            ->where('real_date_close', '<=', now())
            ->inRandomOrder()
            ->first();
        $this->actingAs($user)
            ->get(route('user.nearestPayments'))
            ->assertStatus(200)
            ->assertSeeText('Ожидаемые платежи в течение ')
            ->assertSeeText('Контрагент')
            ->assertSeeText('Название договора')
            ->assertSeeText('Номер и дата')
            ->assertSeeText('Просрочено на')
            ->assertSeeText('Ближайшие платежи по сроку')
            ->assertSeeText('Всего')
            ->assertSeeText($agreement->agr_number)
            ->assertDontSeeText($agreementClosed->agr_number);

    }

}
