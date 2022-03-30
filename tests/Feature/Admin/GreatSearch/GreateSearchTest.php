<?php

namespace Tests\Feature\Admin;


use App\Models\Manufacturer;
use App\Models\User;
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
     *Тестируем страницу войдя под правильным логином и паролем
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
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddManufacturer()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addManufacturer'))
            ->assertStatus(200)
            ->assertSeeText('Добавить нового производителя')
            ->assertSeeText('Наименование производителя')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditManufacturer()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $manufacturer = Manufacturer::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editManufacturer', ['manufacturer' => $manufacturer]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование производителя')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование производителя')
            ->assertSee($manufacturer->name);
    }

}
