<?php

namespace Tests\Feature;


use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class vehiclesTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnAuthorized()
    {
        $this->get(route('admin.vehicles'))
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
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.vehicles'))
            ->assertStatus(302)
        ->assertRedirect(route('home'));
    }



    /**
     * Тестируем общий список единиц техники.
     * @return void
     */
    public function test_indexPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.vehicles'));
        $response->assertStatus(200)
            ->assertSeeText('Справочники')
            ->assertSeeText('Список техники')
            ->assertSeeText('Новая единица');
        $dataCount = DB::table('vehicles')->count();
        if ($dataCount > 0) {
            $response->assertSeeText('Изменить')
                ->assertSeeText('Удалить')
                ->assertDontSeeText('Нет записей');
        } else {
            $response->assertDontSeeText('Изменить')
                ->assertDontSeeText('Удалить')
                ->assertSeeText('Нет записей');
        }
    }

    /**
     * Тестирование окошка добавления записи о новой единицу техники
     * @return void
     */
    public function test_addPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.addVehicle'));
        $response->assertStatus(200)
        ->assertSeeText('Тип техники')
        ->assertSeeText('Производитель')
        ->assertSeeText('Наименование оборудования')
        ->assertSeeText('Заводской номер/VIN')
        ->assertSeeText('Добавить новую единицу техники')
        ->assertSeeText('Отмена');
    }

    /**
     * Тестирование окошка изменения записи об имеющейся единицы техники
     * @return void
     */
    public function test_editPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $vehicle = Vehicle::query()->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.editVehicle',['vehicle'=>$vehicle]));
        $response->assertStatus(200)
            ->assertSeeText('Тип техники')
            ->assertSeeText('Производитель')
            ->assertSeeText('Наименование оборудования')
            ->assertSeeText('Заводской номер/VIN')
            ->assertSeeText('Изменение описания')
            ->assertSeeText('Отмена')
            ->assertSee($vehicle->name);
        ;
    }


}
