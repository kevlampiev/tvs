<?php

namespace Tests\Feature\Admin;


use App\Models\InsuranceCompany;
use App\Models\User;
use Tests\TestCase;

class InsuranceCompaniesTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.insuranceCompanies'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addInsuranceCompany'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $company = InsuranceCompany::query()->inRandomOrder()->first();
        $this->get(route('admin.editInsuranceCompany', ['insuranceCompany' => $company]))
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
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.insuranceCompanies'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addInsuranceCompany'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $company = InsuranceCompany::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editInsuranceCompany', ['insuranceCompany' => $company]))
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
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $company = InsuranceCompany::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.insuranceCompanies'))
            ->assertStatus(200)
            ->assertSeeText('Страховые компании')
            ->assertSeeText('Добавить новую')
            ->assertSeeText('Наименование')
            ->assertSeeText('Изменить')
            ->assertSeeText('Удалить')
            ->assertSeeText($company->name);
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testAddCompany()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addInsuranceCompany'))
            ->assertStatus(200)
            ->assertSeeText('Добавить новую')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование');
    }

    /**
     *Тестируем страницу редактирования войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditCompany()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $company = InsuranceCompany::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editInsuranceCompany', ['insuranceCompany' => $company]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование')
            ->assertSee($company->name);
    }

}
