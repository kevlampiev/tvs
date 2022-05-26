<?php

namespace Tests\Feature\Admin\Vehicles;


use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCondition;
use App\Models\VehicleNote;
use Tests\TestCase;

class vehicleConditionsTest extends TestCase
{

    /**
     *Тестируем невозможность добавления заметки без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {

        $vehicleCondition = VehicleCondition::query()->inRandomOrder()->first();
        $vehicle = $vehicleCondition->vehicle;

        //Не можем войти в список
        $this->get(route('admin.addVehicleCondition', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $this->get(route('admin.editVehicleCondition', ['vehicleCondition' => $vehicleCondition]))
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

        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $vehicleCondition = VehicleCondition::query()->inRandomOrder()->first();
        $vehicle = $vehicleCondition->vehicle;

        //Не можем войти в список
        $this->actingAs($user)
            ->get(route('admin.addVehicleCondition', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $this->actingAs($user)
            ->get(route('admin.editVehicleCondition', ['vehicleCondition' => $vehicleCondition]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Тестируем страницу добавления инцидента войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddVehicleCondition()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()->inRandomOrder()->first();

        $this->actingAs($user)->get(route('admin.addVehicleCondition', ['vehicle' => $vehicle]))
            ->assertStatus(200)
            ->assertSeeText('Добавить данные о состоянии')
            ->assertSee($vehicle->name)
            ->assertSee("Состояние")
            ->assertSeeText('Комментарий')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Тестируем страницу изменения записи об инциденте, войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditVehicleCondition()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicleCondition = VehicleCondition::query()->inRandomOrder()->first();

        $this->actingAs($user)->get(route('admin.editVehicleCondition', ['vehicleCondition' => $vehicleCondition]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование данных')
            ->assertSee($vehicleCondition->vehicle->name)
            ->assertSee($vehicleCondition->description)
            ->assertSeeText('Комментарий')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена');
    }


}
