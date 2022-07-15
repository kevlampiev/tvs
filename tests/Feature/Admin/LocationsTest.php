<?php

namespace Tests\Feature\Admin;


use App\Models\Manufacturer;
use App\Models\User;
use App\Models\VehicleLocation;
use Tests\TestCase;

class LocationsTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.locations'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addLocation'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $location = VehicleLocation::query()->inRandomOrder()->first();
        $this->get(route('admin.editLocation', ['location' => $location]))
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
        $this->actingAs($user)->get(route('admin.locations'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addLocation'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $location = VehicleLocation::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editLocation', ['location' => $location]))
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
        $location = VehicleLocation::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.locations'))
            ->assertStatus(200)
            ->assertSeeText('Места дислокации техники')
            ->assertSeeText('Добавить место дислокации')
            ->assertSeeText('Наименование')
            ->assertSeeText('Адрес')
            ->assertSeeText('Удалить')
            ->assertSeeText($location->name);
    }


    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddLocation()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addLocation'))
            ->assertStatus(200)
            ->assertSeeText('Добавить новое местонахождение')
            ->assertSeeText('Наименование')
            ->assertSeeText('Адрес')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditLocation()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $location = VehicleLocation::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editLocation', ['location' => $location]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование местонахождения техники')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование')
            ->assertSeeText('Адрес')
            ->assertSee($location->name);
    }

}
