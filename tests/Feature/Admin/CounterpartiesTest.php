<?php

namespace Tests\Feature;


use App\Models\Counterparty;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CounterpartiesTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.counterparties'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addCounterparty'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $counterparty = Counterparty::query()->inRandomOrder()->first();
        $this->get(route('admin.editCounterparty', ['counterparty' => $counterparty]))
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
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.counterparties'))
            ->assertStatus(302)
        ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addCounterparty'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $counterparty = Counterparty::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editCounterparty', ['counterparty' => $counterparty]))
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
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $counterparty = Counterparty::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.counterparties'))
            ->assertStatus(200)
            ->assertSeeText('Реестр контрагентов')
            ->assertSeeText('Новый контрагент')
            ->assertSeeText('Наименование')
            ->assertSeeText('Изменить')
            ->assertSeeText('Удалить')
            ->assertSeeText($counterparty->name);
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddCounterparty()
    {
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addCounterparty'))
            ->assertStatus(200)
            ->assertSeeText('Добавить нового')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditCounterparty()
    {
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $counterparty = Counterparty::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editCounterparty', ['counterparty' => $counterparty]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование контрагента')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование')
            ->assertSee($counterparty->name);
    }

}
