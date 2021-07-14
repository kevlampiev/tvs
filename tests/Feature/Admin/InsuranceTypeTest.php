<?php

namespace Tests\Feature\Admin;


use App\Models\Counterparty;
use App\Models\InsuranceType;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class InsuranceTypeTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.insuranceTypes'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addInsuranceType'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $insType = InsuranceType::query()->inRandomOrder()->first();
        $this->get(route('admin.editInsuranceType', ['insuranceType' => $insType]))
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
        $this->actingAs($user)->get(route('admin.insuranceTypes'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addInsuranceType'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $insType = InsuranceType::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editInsuranceType', ['insuranceType' => $insType]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Тестируем страницу войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testList()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $insType = InsuranceType::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.insuranceTypes'))
            ->assertStatus(200)
            ->assertSeeText('Виды страховок')
            ->assertSeeText('Новый тип')
            ->assertSeeText('Наименование')
            ->assertSeeText('Изменить')
            ->assertSeeText('Удалить')
            ->assertSeeText($insType->name);
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAdd()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addInsuranceType'))
            ->assertStatus(200)
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование типа страховки');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEdit()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $insType = InsuranceType::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editInsuranceType', ['insuranceType' => $insType]))
            ->assertStatus(200)
            ->assertSeeText('Изменение')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование типа страховки')
            ->assertSee($insType->name);
    }

}
