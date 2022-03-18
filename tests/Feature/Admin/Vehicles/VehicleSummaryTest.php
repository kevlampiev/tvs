<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use App\Models\Vehicle;
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
        $this->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'summary']))
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
            ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'agreements']))
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
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'main']))
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
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();
        $response = $this->actingAs($user)
            ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'agreements']))
            ->assertStatus(200)
            ->assertSeeText($vehicle->VIN);
        if ($vehicle->agreements->count() !== 0) {
            $response->assertSeeText('Удалить')
                ->assertSeeText($vehicle->agreements->first()->agr_name);
        }
    }

    /**
     * Смотрим на страницу insurances
     *
     * @return void
     */
    public function testInsurancesTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->whereHas('insurances')
            ->inRandomOrder()->first();
        if ($vehicle) {
            $response = $this->actingAs($user)
                ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'insurances']))
                ->assertStatus(200)
                ->assertSeeText($vehicle->insurances->first()->insuranceCompany->name)
                ->assertSeeText('Новый полис')
                ->assertSeeText('Удалить')
                ->assertSeeText('Изменить');
        } else {
            $vehicle = Vehicle::query()
                ->inRandomOrder()->first();
            $response = $this->actingAs($user)
                ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'insurances']))
                ->assertStatus(200)
                ->assertSeeText('Страховые полисы')
                ->assertSeeText('Нет записей')
                ->assertSeeText('Новый полис');
        }
    }


    /**
     * Смотрим на страницу Notes
     *
     * @return void
     */
    public function testNotesTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->whereHas('insurances')
            ->inRandomOrder()->first();
        if (count($vehicle->notes) !== 0) {
            $response = $this->actingAs($user)
                ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'notes']))
                ->assertStatus(200)
                ->assertSeeText($vehicle->notes[0]->note_body);
        } else {
            $vehicle = Vehicle::query()
                ->inRandomOrder()->first();
            $response = $this->actingAs($user)
                ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'notes']))
                ->assertStatus(200)
                ->assertSeeText('Нет заметок по данной единице техники');
        }
    }

    /**
     * Смотрим на страницу Photos
     *
     * @return void
     */
    public function testPhotoTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->whereHas('photos')
            ->inRandomOrder()->first();
        if (count($vehicle->photos) !== 0) {
            $response = $this->actingAs($user)
                ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'photos']))
                ->assertStatus(200)
                ->assertSee("card-img-top vehicle-show-img m-1");
        } else {
            $vehicle = Vehicle::query()
                ->inRandomOrder()->first();
            $response = $this->actingAs($user)
                ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'photos']))
                ->assertStatus(200)
                ->assertSeeText('Для данной единицы техники нет фотографий');
        }
    }


    /**
     *Тестируем страницу залогов
     *
     * @return void
     */
    public function testDepositsTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $vehicle = Vehicle::query()
            ->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'deposits']))
            ->assertStatus(200)
            ->assertSeeText($vehicle->name)
            ->assertSeeText($vehicle->vin)
            ->assertSeeText('Договора по которым техника передана в залог')
            ->assertSeeText('Добавить договор по которому техника служит залогом')
            ->assertSeeText('Договор')
            ->assertSeeText('Дата начала залога')
            ->assertSeeText('Плановая дата окончания залога')
            ->assertSeeText('Договор/комментарий');
        if ($vehicle->deposits->count() > 0) {
            $response->assertSeeText('Карточка')
                ->assertSeeText('Изменить')
                ->assertSeeText('Удалить');
        }
//        else {
//            $response->assertDontSeeText('Нет данных для отображения');
//        }
    }



}
