<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LoadBankStatementTest extends TestCase
{

    /**
     *Тестируем невозможность входа без авторизации
     *
     * @return void
     */
    public function testUnAuthorized()
    {
        $this->get(route('admin.loadBankStatement'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     *Тестируем невозможность входа простым юзером или менеджером
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', '<>','admin')->inRandomOrder()->first();
        $this->actingAs($user)->get(route('admin.loadBankStatement'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }


    /**
     * Тестируем страницу загрузки выпискок.
     * @return void
     */
    public function test_indexPage()
    {
        $user = User::query()->where('role','=', 'admin')->inRandomOrder()->first();
        $response = $this->actingAs($user)->get(route('admin.loadBankStatement'));
        $response->assertStatus(200)
            ->assertSeeText('Загрузка выписки 1С')
            ->assertSeeText('Дата')
            ->assertSeeText('Плательщик');
    }


}
