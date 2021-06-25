<?php

namespace Tests\Feature;


use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ManufacturersTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.manufacturers'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addManufacturer'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $manufacturer = Manufacturer::query()->inRandomOrder()->first();
        $this->get(route('admin.editManufacturer', ['manufacturer' => $manufacturer]))
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
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.manufacturers'))
            ->assertStatus(302)
        ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addManufacturer'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $manufacturer = VehicleType::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editManufacturer', ['manufacturer' => $manufacturer]))
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
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $manufacturer = Manufacturer::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.manufacturers'))
            ->assertStatus(200)
            ->assertSeeText('Производители')
            ->assertSeeText('Новый производитель')
            ->assertSeeText('Наименование')
            ->assertSeeText('Изменить')
            ->assertSeeText('Удалить')
            ->assertSeeText($manufacturer->name);
    }


    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddManufacturer()
    {
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addManufacturer'))
            ->assertStatus(200)
            ->assertSeeText('Добавить нового производителя')
            ->assertSeeText('Наименование производителя')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditManufacturer()
    {
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $manufacturer = Manufacturer::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editManufacturer', ['manufacturer' => $manufacturer]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование производителя')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование производителя')
            ->assertSee($manufacturer->name);
    }

}
