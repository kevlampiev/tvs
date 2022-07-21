<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleIncident;
use App\Models\VehicleNote;
use App\Models\VehiclePlacement;
use Tests\TestCase;

class vehiclePlacementsTest extends TestCase
{

    /**
     *Тестируем невозможность добавления местоположения конкретной техники
     *
     * @return void
     */
    public function testUnauthorized()
    {

        $placement = VehiclePlacement::query()->inRandomOrder()->first();
        $vehicle = $placement->vehicle;

        //Не можем войти в список
        $this->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'placements']))
            ->assertStatus(302)
            ->assertRedirect('login');

        //Не можем добавить новое местоположение
        $this->get(route('admin.addPlacement', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $this->get(route('admin.editPlacement', ['placement' => $placement]))
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
        $placement = VehiclePlacement::query()->inRandomOrder()->first();
        $vehicle = $placement->vehicle;

        //Не можем войти в список
        $this->actingAs($user)
            ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'placements']))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //Не можем добавить новое местоположение для техники
        $this->actingAs($user)
            ->get(route('admin.addPlacement', ['vehicle' => $vehicle]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $this->actingAs($user)
            ->get(route('admin.editPlacement', ['placement' => $placement]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Тестируем страницу добавления инцидента войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddAsManagerOrAdmin()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $placement = VehiclePlacement::query()->inRandomOrder()->first();
        $vehicle = $placement->vehicle;

        $this->actingAs($user)->get(route('admin.addPlacement', ['vehicle' => $vehicle]))
            ->assertStatus(200)
            ->assertSeeText('Установить местонахождение единицы техники')
            ->assertSee($vehicle->name)
            ->assertSeeText('Дата перевода в локацию')
            ->assertSeeText('Комментарий')
            ->assertSeeText($placement->location->name)
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Тестируем страницу изменения записи об инциденте, войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditAsManagerOrAdmin()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $placement = VehiclePlacement::query()->inRandomOrder()->first();
        $vehicle = $placement->vehicle;

        $this->actingAs($user)->get(route('admin.editPlacement', ['placement' => $placement]))
            ->assertStatus(200)
            ->assertSeeText('Установить местонахождение единицы техники')
            ->assertSee($vehicle->name)
            ->assertSeeText('Дата перевода в локацию')
            ->assertSeeText('Комментарий')
            ->assertSeeText($placement->location->name)
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }


}
