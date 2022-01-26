<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use App\Models\VehiclePhoto;
use Tests\TestCase;

class VehiclePhotoEditTest extends TestCase
{
    /**
     * Попытка отредактировать картинку техники без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $photo = VehiclePhoto::query()->where('vehicle_id', '<>', null)->
        inRandomOrder()->first();
        $this->get(route('admin.editVehiclePhoto', ['vehiclePhoto' => $photo]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * Попытка изменить картинку под простым пользователем
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $photo = VehiclePhoto::query()->where('vehicle_id', '<>', null)->
        inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editVehiclePhoto', ['vehiclePhoto' => $photo]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     * Попытка изменить картинку менеджером или администратором
     *
     * @return void
     */
    public function testAsManager()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $photo = VehiclePhoto::query()->where('vehicle_id', '<>', null)->
        inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editVehiclePhoto', ['vehiclePhoto' => $photo]))
            ->assertStatus(200)
            ->assertSeeText('Изменение фотографии')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Комментарий')
            ->assertSee($photo->vehicle->name)
            ->assertSee($photo->description);
    }


}
