<?php

namespace Tests\Feature;


use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class vehiclesTest extends TestCase
{
    /**
     * Тестируем общий список единиц техники.
     * @return void
     */
    public function test_indexPage()
    {
        $response = $this->get('/admin/vehicles');
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
        $response = $this->get('/admin/vehicles/add');
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
        $vehicle = Vehicle::query()->inRandomOrder()->first();
        if (!$vehicle) return;
        $response = $this->get('/admin/vehicles/'.$vehicle->id.'/edit');
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
