<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class vehicleTypesTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.vehicleTypes'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addVehicleType'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $vehicleType = VehicleType::query()->inRandomOrder()->first();
        $this->get(route('admin.editVehicleType', ['vehicleType' => $vehicleType]))
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
        $this->actingAs($user)->get(route('admin.vehicleTypes'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addVehicleType'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $vehicleType = VehicleType::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editVehicleType', ['vehicleType' => $vehicleType]))
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
        $vehicleType = VehicleType::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.vehicleTypes'))
            ->assertStatus(200)
            ->assertSeeText('Новый тип')
            ->assertSeeText('Наименование')
            ->assertSeeText('Изменить')
            ->assertSeeText('Удалить')
            ->assertSeeText($vehicleType->name);
    }


    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddVehicleType()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addVehicleType'))
            ->assertStatus(200)
            ->assertSeeText('Добавить новый тип')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование типа');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditVehicleType()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicleType = VehicleType::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editVehicleType', ['vehicleType' => $vehicleType]))
            ->assertStatus(200)
            ->assertSeeText('Изменение типа')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование типа')
            ->assertSee($vehicleType->name);
    }

}
