<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleNote;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class vehicleNotesTest extends TestCase
{

    /**
     *Тестируем невозможность добавления заметки без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {

        $vehicleNote = VehicleNote::query()->inRandomOrder()->first();
        $vehicle = $vehicleNote->vehicle;

        //Не можем войти в список
        $this->get(route('admin.addVehicleNote',['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $this->get(route('admin.editVehicleNote', ['vehicleNote' => $vehicleNote]))
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
        $vehicleNote = VehicleNote::query()->inRandomOrder()->first();
        $vehicle = $vehicleNote->vehicle;

        //Не можем войти в список
        $this->actingAs($user)
            ->get(route('admin.addVehicleNote',['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $this->actingAs($user)
            ->get(route('admin.editVehicleNote', ['vehicleNote' => $vehicleNote]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Тестируем страницу добавления заметки войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddVehicleNote()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()->inRandomOrder()->first();

        $this->actingAs($user)->get(route('admin.addVehicleNote',['vehicle' => $vehicle]))
            ->assertStatus(200)
            ->assertSeeText('Добавить заметку')
            ->assertSee($vehicle->name)
            ->assertSeeText('Текст заметки')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Тестируем страницу изменения заметки войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditVehicleNote()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicleNote = VehicleNote::query()->inRandomOrder()->first();

        $this->actingAs($user)->get(route('admin.editVehicleNote',['vehicleNote' => $vehicleNote]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование заметки')
            ->assertSee($vehicleNote->vehicle->name)
            ->assertSee($vehicleNote->note_body)
            ->assertSeeText('Текст заметки')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена');
    }


}
