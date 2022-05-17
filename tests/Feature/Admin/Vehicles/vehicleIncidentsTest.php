<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleIncident;
use App\Models\VehicleNote;
use Tests\TestCase;

class vehicleIncidentsTest extends TestCase
{

    /**
     *Тестируем невозможность добавления заметки без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {

        $vehicleIncident = VehicleIncident::query()->inRandomOrder()->first();
        $vehicle = $vehicleIncident->vehicle;

        //Не можем войти в список
        $this->get(route('admin.addVehicleIncident', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $this->get(route('admin.editVehicleIncident', ['vehicleIncident' => $vehicleIncident]))
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
        $vehicleIncident = VehicleIncident::query()->inRandomOrder()->first();
        $vehicle = $vehicleIncident->vehicle;

        //Не можем войти в список
        $this->actingAs($user)
            ->get(route('admin.addVehicleIncident', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $this->actingAs($user)
            ->get(route('admin.editVehicleIncident', ['vehicleIncident' => $vehicleIncident]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Тестируем страницу добавления инцидента войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddVehicleIncident()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()->inRandomOrder()->first();

        $this->actingAs($user)->get(route('admin.addVehicleIncident', ['vehicle' => $vehicle]))
            ->assertStatus(200)
            ->assertSeeText('Добавить данные об инциденте')
            ->assertSee($vehicle->name)
            ->assertSeeText('Описание инцидента')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Тестируем страницу изменения записи об инциденте, войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditVehicleIncident()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicleIncident = VehicleIncident::query()->inRandomOrder()->first();

        $this->actingAs($user)->get(route('admin.editVehicleIncident', ['vehicleIncident' => $vehicleIncident]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование данных')
            ->assertSee($vehicleIncident->vehicle->name)
            ->assertSee($vehicleIncident->description)
            ->assertSeeText('Описание инцидента')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена');
    }


}
