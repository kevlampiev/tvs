<?php

namespace Tests\Feature\Admin\Companies;


use App\Models\Company;
use App\Models\PowerOfAttorney;
use App\Models\User;
use Tests\TestCase;
use function route;

class PowerOfAttorneysTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
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
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();
        $company = Company::query()->inRandomOrder()->first();
        //Не можем открыть окно добавления новой доверенности
        $this->actingAs($user)->get(route('admin.addPOA', ['company' => $company]))
            ->assertStatus(302)
            ->assertRedirect('/');

        //не проходим на страницу редактирования
        $powerOfAttorney = PowerOfAttorney::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editPOA', ['powerOfAttorney' => $powerOfAttorney]))
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    /**
     *Тестируем возможность добавления и редактирования войдя под правильным логином и паролем
     *
     * @return void
     */
    public function testList()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $company = Company::query()->inRandomOrder()->first();

        $this->actingAs($user)->get(route('admin.addPOA', ['company' => $company]))
            ->assertStatus(200)
            ->assertSeeText($company->name)
            ->assertSeeText('Добавить новую')
            ->assertSeeText('На кого выдана')
            ->assertSeeText('Номер доверенности')
            ->assertSeeText('Краткое описание')
            ->assertSeeText('Текст доверенности')
            ->assertSeeText('Добавить');

        //не проходим на страницу редактирования
        $powerOfAttorney = PowerOfAttorney::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editPOA', ['powerOfAttorney' => $powerOfAttorney]))
            ->assertStatus(200)
            ->assertSeeText($powerOfAttorney->company->name)
            ->assertSeeText('Редактирование доверенности')
            ->assertSeeText('На кого выдана')
            ->assertSeeText('Номер доверенности')
            ->assertSeeText('Краткое описание')
            ->assertSeeText('Текст доверенности')
            ->assertSeeText('Изменить')
            ->assertSee($powerOfAttorney->poa_number)
            ->assertSee($powerOfAttorney->issued_for)
            ->assertSee($powerOfAttorney->subject)
            ->assertSee($powerOfAttorney->description);

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
