<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class InsuredVehiclesTest extends TestCase
{
    /**
     * Попытка посетить страницу без авторизации.
     *
     * @return void
     */
    public function testVisitAsGuest()
    {
        //Заход без логина
        $response = $this->get(route('admin.insuredVehicles'));
        $response->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     * Попытка посетить страницу в качесте простого user'a
     *
     * @return void
     */
    public function testVisitAsUser()
    {
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.insuredVehicles'));
        $response->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Заход после авторизации
     *
     * @return void
     */
    public function testVisitAuth()
    {
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $insurance = DB::selectOne('select * from v_insurances_most_actual order by rand() limit 1');
        $this->actingAs($user)
            ->get(route('admin.insuredVehicles'))
            ->assertStatus(200)
            ->assertSeeText('Отчет о состоянии страхования техники')
            ->assertSeeText($insurance->vehicle)
            ->assertSeeText($insurance->insurance_type)
            ->assertSeeText($insurance->insurance_company);

    }

}
