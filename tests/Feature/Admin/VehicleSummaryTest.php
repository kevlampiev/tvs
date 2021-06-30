<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VehicleSummaryTest extends TestCase
{
    /**
     * Попытка зайти без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $this->get(route('admin.vehicleSummary', [ 'vehicle' => $vehicle, 'page'=>'summary']))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * Попытка зайти под простым пользователем
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.vehicleSummary', [ 'vehicle' => $vehicle, 'page'=>'agreements']))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     * Смотрим на главную страницу
     *
     * @return void
     */
    public function testMainTab()
    {
        $user = User::query()->where('role','<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.vehicleSummary', [ 'vehicle' => $vehicle, 'page'=>'main']))
            ->assertStatus(200)
            ->assertSeeText($vehicle->VIN);
    }


    /**
     * Смотрим на страницу agreements
     *
     * @return void
     */
    public function testVehiclesTab()
    {
        $user = User::query()->where('role','<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $response= $this->actingAs($user)
            ->get(route('admin.vehicleSummary', [ 'vehicle' => $vehicle, 'page'=>'agreements']))
            ->assertStatus(200)
        ->assertSeeText($vehicle->VIN);
        if ($vehicle->agreements->count()!==0) {
            $response->assertSeeText('Удалить')
            ->assertSeeText($vehicle->agreements->first()->agr_name);
        }
    }


}
