<?php

namespace Tests\Feature\Admin;


use App\Models\Company;
use App\Models\User;
use Tests\TestCase;

class CompaniesTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.companies'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу добавления
        $this->get(route('admin.addCompany'))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $company = Company::query()->inRandomOrder()->first();
        $this->get(route('admin.editCompany', ['company' => $company]))
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
        $this->actingAs($user)->get(route('admin.companies'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу добавления
        $this->actingAs($user)
            ->get(route('admin.addCompany'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        //не проходим на страницу редактирования
        $company = Company::query()->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editCompany', ['company' => $company]))
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
        $company = Company::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.companies'))
            ->assertStatus(200)
            ->assertSeeText('Компании группы')
            ->assertSeeText('Добавить компанию')
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
        $this->actingAs($user)->get(route('admin.addCompany'))
            ->assertStatus(200)
            ->assertSeeText('Добавить новую')
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование')
            ->assertSeeText('Код');
    }

    /**
     *Тестируем страницу добавления войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testEditCompany()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $company = Company::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editCompany', ['company' => $company]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование компании')
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Наименование')
            ->assertSeeText('Код')
            ->assertSee($company->name)
            ->assertSee($company->code);
    }

}
