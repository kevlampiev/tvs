<?php

namespace Tests\Feature\Admin;

use App\Models\Agreement;
use App\Models\User;
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
        $response = $this->get(route('admin.allSettlements'));
        $response->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     * Попытка зайти на сайт в качестве простого user'a.
     *
     * @return void
     */
    public function testVisitAsUser()
    {
        $user = User::query()->where('role','=', 'user')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.allSettlements'));
        $response->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Заход после авторизации на отчет по всем задолженностям в форме 1
     *
     * @return void
     */
    public function testVisitAuth1()
    {
        //берем незакрытый договор
        $agreement = Agreement::query()
            ->where('real_date_close', '=', null)
            ->inRandomOrder()
            ->first();
        //берем закрытый договор
        $agreementClosed = Agreement::query()
            ->whereNotNull('real_date_close')
            ->where('real_date_close', '<', now())
            ->inRandomOrder()
            ->first();

        //Зайти как простой юзер
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.allSettlements'))
            ->assertStatus(200)
            ->assertSeeText('Задолженость по финансовым договорам')
            ->assertSeeText('Контрагент')
            ->assertSeeText('Всего')
            ->assertSeeText($agreement->agr_number)
            ->assertDontSeeText($agreementClosed->agr_number);
    }

    /**
     *Заход после авторизации на отчет по всем задолженностям в форме 2
     *
     * @return void
     */
    public function testVisitAuth2()
    {
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

        //Зайти как простой юзер
        $user = User::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.allSettlements2'))
            ->assertStatus(200)
            ->assertSeeText('Задолженость по финансовым договорам')
            ->assertSeeText('Компания')
            ->assertSeeText('Всего')
            ->assertSeeText($agreement->agr_number)
            ->assertDontSeeText($agreementClosed->agr_number);
    }


}
