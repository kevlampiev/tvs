<?php

namespace Tests\Feature\Admin;


use App\Models\User;
use Tests\TestCase;

class ExportsInsuranceTest extends TestCase
{

    /**
     *Тестируем невозможность скачивания без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        //Не можем войти в список
        $this->get(route('admin.exportInsurances'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     *Тестируем невозможность скачивания простым пользователем
     *
     * @return void
     */
    public function testExportAsUser()
    {
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();
        //Не можем войти в список
        $this->actingAs($user)->get(route('admin.exportInsurances'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Можно скачать с ролью manager или admin
     *
     * @return void
     */
    public function testExportAsManager()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        //Не можем войти в список
        $this->actingAs($user)->get(route('admin.exportInsurances'))
            ->assertStatus(200);
    }


}
