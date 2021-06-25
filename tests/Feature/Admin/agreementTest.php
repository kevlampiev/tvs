<?php

namespace Tests\Feature;


use App\Models\Agreement;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class agreementTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnAuthorized()
    {
        $this->get(route('admin.agreements'))
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
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.agreements'))
            ->assertStatus(302)
        ->assertRedirect(route('home'));
    }



    /**
     * Тестируем общий список договоров.
     * @return void
     */
    public function test_indexPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.agreements'));
        $response->assertStatus(200)
            ->assertSeeText('Справочники')
            ->assertSeeText('Заключенные договоры')
            ->assertSeeText('Новый договор');
        $dataCount = DB::table('agreements')->count();
        if ($dataCount > 0) {
            $response->assertSeeText('Изменить')
                ->assertSeeText('Карточка')
                ->assertSeeText('Удалить')
                ->assertDontSeeText('Нет записей');
        } else {
            $response->assertDontSeeText('Изменить')
                ->assertDontSeeText('Удалить')
                ->assertDontSeeText('Карточка')
                ->assertSeeText('Нет записей');
        }
    }

    /**
     * Неавторизованный человек не может добавить новый договор
     * @return void
     */
    public function testAddUnauthorized()
    {
        $this->get(route('admin.addAgreement'))
            ->assertStatus(302);
    }

    /**
     * Простой пользователь не может добавить новый договор
     * @return void
     */
    public function testAddAsUser()
    {
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addAgreement'))
            ->assertStatus(302);
    }

    /**
     * Тестирование окошка добавления записи о новом договоре
     * @return void
     */
    public function test_addPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.addAgreement'));
        $response->assertStatus(200)
        ->assertSeeText('Наименование договора')
        ->assertSeeText('Компания группы')
        ->assertSeeText('Контрагент')
        ->assertSeeText('Тип договора')
        ->assertSeeText('Номер договора')
        ->assertSeeText('Срок действия')
        ->assertSeeText('Основной долг/стоимость имущества')
        ->assertSeeText('Процентная ставка')
        ->assertSeeText('Добавить')
        ->assertDontSeeText('Изменить')
        ->assertSeeText('Отмена');
    }

    /**
     * Неавторизованный пользователь не может начать редактировать договор
     * @return void
     */
    public function test_editPage_asGuest()
    {
        $agreement = Agreement::query()->inRandomOrder()->first();
        $this->get(route('admin.editAgreement',['agreement'=>$agreement]))
        ->assertStatus(302);
    }

    /**
     * Простой user не может начать редактировать договор
     * @return void
     */
    public function test_editPage_asUser()
    {
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $agreement = Agreement::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editAgreement',['agreement'=>$agreement]))
            ->assertStatus(302);
    }

    /**
     * Тестирование окошка изменения записи об имеющемся договоре
     * @return void
     */
    public function test_editPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $agreement = Agreement::query()->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.editAgreement',['agreement'=>$agreement]));
        $response->assertStatus(200)
            ->assertSeeText('Наименование договора')
            ->assertSeeText('Компания группы')
            ->assertSeeText('Контрагент')
            ->assertSeeText('Тип договора')
            ->assertSeeText('Номер договора')
            ->assertSeeText('Срок действия')
            ->assertSeeText('Основной долг/стоимость имущества')
            ->assertSeeText('Процентная ставка')
            ->assertSeeText('Изменить')
            ->assertDontSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSee($agreement->name);
        ;
    }


}
