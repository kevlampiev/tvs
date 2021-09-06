<?php

namespace Tests\Feature\Admin;


use App\Models\Counterparty;
use App\Models\Document;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VehicleDocumentsTest extends TestCase
{

    /**
     *Тестируем невозможность добавления/редактирования документа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $document = Document::query()->where('vehicle_id','<>',null)->first();
        $vehicle = $document->vehicle;
        //Не можем войти в список
        $this->get(route('admin.addVehicleDocument', ['vehicle'=>$vehicle]))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $this->get(route('admin.editVehicleDocument', ['vehicle'=>$vehicle, 'document' => $document]))
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
        $document = Document::query()->where('vehicle_id','<>',null)->first();
        $vehicle = $document->vehicle;
        //Не можем войти в список
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addVehicleDocument', ['vehicle'=>$vehicle]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.editVehicleDocument', ['vehicle'=>$vehicle, 'document' => $document]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddVehicleDocument()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $document = Document::query()->where('vehicle_id','<>',null)->first();
        $vehicle = $document->vehicle;

        $this->actingAs($user)->get(route('admin.addVehicleDocument', ['vehicle'=>$vehicle]))
            ->assertStatus(200)
            ->assertSeeText('Добавить новый документ')
            ->assertSeeText('Файл полиса отсутствует')
            ->assertSeeText('Связанная техника')
            ->assertSeeText('Наименование документа')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSee($vehicle->name);
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditVehicleDocument()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $document = Document::query()->where('vehicle_id','<>',null)->first();
        $vehicle = $document->vehicle;

        $this->actingAs($user)->get(route('admin.editVehicleDocument', ['vehicle'=>$vehicle, 'document' => $document]))
            ->assertStatus(200)
            ->assertSeeText('Изменение данных')
            ->assertSeeText('Файл доступен для скачивания')
            ->assertSeeText('Связанная техника')
            ->assertSeeText('Наименование документа')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSee($vehicle->name)
            ->assertSee($document->name);
    }

//    /**
//     *Тестируем страницу добавления войдя под правильным логином и паролем
//     *
//     * @return void
//     */
//    public function testEditCounterparty()
//    {
//        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
//        $counterparty = Counterparty::query()->inRandomOrder()->first();
//        $this->actingAs($user)->get(route('admin.editCounterparty', ['counterparty' => $counterparty]))
//            ->assertStatus(200)
//            ->assertSeeText('Редактирование контрагента')
//            ->assertSeeText('Изменить')
//            ->assertSeeText('Отмена')
//            ->assertSeeText('Наименование')
//            ->assertSee($counterparty->name);
//    }

}
