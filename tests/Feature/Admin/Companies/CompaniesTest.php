<?php

namespace Tests\Feature\Admin\Companies;


use App\Models\Company;
use App\Models\PowerOfAttorney;
use App\Models\User;
use Tests\TestCase;
use function route;

class CompaniesTest extends TestCase
{

    /**
     *Тестируем невозможность добавления новой доверенности или редактирования текущей без регистрации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $company = Company::query()->inRandomOrder()->first();
        //Не можем открыть окно добавления новой доверенности
        $this->get(route('admin.addPOA', ['company' => $company]))
            ->assertStatus(302)
            ->assertRedirect('login');

        //не проходим на страницу редактирования
        $powerOfAttorney = PowerOfAttorney::query()->inRandomOrder()->first();
        $this->get(route('admin.editPOA', ['powerOfAttorney' => $powerOfAttorney]))
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
