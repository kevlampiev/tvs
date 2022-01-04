<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VehiclePhotoAddTest extends TestCase
{
    /**
     * Попытка добавить картинку техники без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $this->get(route('admin.addVehiclePhoto', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * Попытка добпаить картинку под простым пользователем
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.addVehiclePhoto', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     * Попытка добпаить картинку менеджером или администратором
     *
     * @return void
     */
    public function testAsManager()
    {
        $user = User::query()->where('role', '<>','user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.addVehiclePhoto', ['vehicle' => $vehicle]))
            ->assertStatus(200)
            ->assertSeeText('Добавить фотографию техники')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Комментарий')
            ->assertSee($vehicle->name)
        ;
    }


}
