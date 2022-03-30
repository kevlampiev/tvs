<?php

namespace Tests\Feature\Admin\Companies;


use App\Models\Company;
use App\Models\PowerOfAttorney;
use App\Models\User;
use Tests\TestCase;
use function route;

class CompanySummaryTest extends TestCase
{

    /**
     *Тестируем невозможность просмотра карточки компании без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $company = Company::query()->inRandomOrder()->first();
        $this->get(route('admin.companySummary', ['company' => $company]))
            ->assertStatus(302)
            ->assertRedirect('login');
    }


    /**
     *Тестируем невозможность просмотра карточки компании простым юзером
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $company = Company::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.companySummary', ['company' => $company]))
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
        $this->actingAs($user)->get(route('admin.companySummary', ['company' => $company]))
            ->assertStatus(200)
            ->assertSeeText('Карточка компании '.$company->name)
            ->assertSeeText('Основная информация')
            ->assertSeeText('Основные данные')
            ->assertSeeText('Код')
            ->assertSeeText($company->code);

        $this->actingAs($user)->get(route('admin.companySummary', ['company' => $company, 'page'=>'poas']))
            ->assertStatus(200)
            ->assertSeeText('Карточка компании '.$company->name)
            ->assertSeeText('Выданные доверенности')
            ->assertSeeText('Добавить Доверенность')
            ->assertSeeText('Номер доверенности');
    }

}
