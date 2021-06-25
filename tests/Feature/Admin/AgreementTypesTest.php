<?php

namespace Tests\Feature;


use App\Models\AgreementType;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AgreementTypesTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.agrTypes'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addAgrType'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $agreementType = AgreementType::query()->inRandomOrder()->first();
        $this->get(route('admin.editAgrType', ['agrType' => $agreementType]))
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
        $this->actingAs($user)->get(route('admin.agrTypes'))
            ->assertStatus(302)
        ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addAgrType'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $agreementType = AgreementType::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editAgrType', ['agrType' => $agreementType]))
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
        $agreementType = AgreementType::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.agrTypes'))
            ->assertStatus(200)
            ->assertSeeText('Новый тип')
            ->assertSeeText('Наименование')
            ->assertSeeText('Изменить')
            ->assertSeeText('Удалить')
            ->assertSeeText($agreementType->name);
    }


    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddAgreementType()
    {
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addAgrType'))
            ->assertStatus(200)
            ->assertSeeText('Добавить новый тип договора')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование типа договора');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditAgreementType()
    {
        $user = User::query()->where('role','<>','user')->inRandomOrder()->first();
        $agreementType = AgreementType::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editAgrType', ['agrType' => $agreementType]))
            ->assertStatus(200)
            ->assertSeeText('Изменение типа договора')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование типа договора')
            ->assertSee($agreementType->name);
    }

}
