<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class insuranceTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnAuthorized()
    {
        $this->get(route('admin.insurances'))
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
        $this->actingAs($user)->get(route('admin.insurances'))
            ->assertStatus(302)
        ->assertRedirect(route('home'));
    }



    /**
     * Тестируем общий список полисов
     * @return void
     */
    public function test_indexPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.insurances'));
        $response->assertStatus(200)
            ->assertSeeText('Страховые полисы')
            ->assertSeeText('Единица техники')
            ->assertSeeText('Страховщик')
            ->assertSeeText('Тип полиса')
            ->assertSeeText('Новый договор');
        $dataCount = DB::table('insurances')->count();
        if ($dataCount > 0) {
            $response->assertSeeText('Изменить')
                ->assertSeeText('Удалить')
                ->assertDontSeeText('Нет записей');
        } else {
            $response->assertDontSeeText('Изменить')
                ->assertDontSeeText('Удалить')
                ->assertSeeText('Нет записей');
        }
    }

    /**
     * Неавторизованный человек не может добавить новый полис
     * @return void
     */
    public function testAddUnauthorized()
    {
        $this->get(route('admin.addInsurance'))
            ->assertStatus(302);
    }

    /**
     * Простой пользователь не может добавить новый полис
     * @return void
     */
    public function testAddAsUser()
    {
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.addInsurance'))
            ->assertStatus(302);
    }

    /**
     * Тестирование окошка добавления записи о новом полисе
     * @return void
     */
    public function test_addPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.addInsurance'));
        $response->assertStatus(200)
        ->assertSeeText('Добавить новый полис страхования')
        ->assertSeeText('Номер полиса')
        ->assertSeeText('Страховщик')
        ->assertSeeText('Тип полиса')
        ->assertSeeText('Срок действия')
        ->assertSeeText('Страховая сумма')
        ->assertSeeText('Страховая премия')
        ->assertSeeText('Добавить')
        ->assertDontSeeText('Изменить')
        ->assertSeeText('Отмена');
    }

    /**
     * Неавторизованный пользователь не может начать редактировать полис
     * @return void
     */
    public function test_editPage_asGuest()
    {
        $insurance = Insurance::query()->inRandomOrder()->first();
        $this->get(route('admin.editInsurance',['insurance'=>$insurance]))
        ->assertStatus(302);
    }

    /**
     * Простой user не может начать редактировать полис
     * @return void
     */
    public function test_editPage_asUser()
    {
        $user = User::query()->where('role','user')->inRandomOrder()->first();
        $insurance = Insurance::query()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.editInsurance',['insurance'=>$insurance]))
            ->assertStatus(302);
    }

    /**
     * Тестирование окошка изменения записи об имеющемся полисе
     * @return void
     */
    public function test_editPage()
    {
        $user = User::query()->where('role','manager')->orWhere('role','admin')->inRandomOrder()->first();
        $insurance = Insurance::query()->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.editInsurance',['insurance'=>$insurance]));
        $response->assertStatus(200)
            ->assertSeeText('Добавить новый полис страхования')
            ->assertSeeText('Номер полиса')
            ->assertSeeText('Страховщик')
            ->assertSeeText('Тип полиса')
            ->assertSeeText('Срок действия')
            ->assertSeeText('Страховая сумма')
            ->assertSeeText('Страховая премия')
            ->assertSeeText('Изменить')
            ->assertDontSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSee($insurance->policy_number);
        ;
    }


}
