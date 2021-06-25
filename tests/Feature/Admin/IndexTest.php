<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * Попытка зайти без авторизации
     *
     * @return void
     */
    public function testUnauhorized()
    {
        $response = $this->get(route('admin.main'))
//            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testAsUser()
    {
        $user= User::query()->where('role','user')->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.main'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    public function testAsManager()
    {
        $user= User::query()->where('role','manager')->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.main'))
            ->assertStatus(200)
            ->assertSeeText('Список техники')
            ->assertSeeText('Договоры')
            ->assertSeeText('Справочники');
    }

    public function testAsAdmin()
    {
        $user= User::query()->where('role','admin')->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.main'))
            ->assertStatus(200)
            ->assertSeeText('Список техники')
            ->assertSeeText('Договоры')
            ->assertSeeText('Справочники');
    }





}
