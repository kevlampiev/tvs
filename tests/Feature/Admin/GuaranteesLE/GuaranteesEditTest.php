<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\AgreementNote;
use App\Models\Document;
use App\Models\GuaranteeLegalEntity;
use App\Models\User;
use Tests\TestCase;

class GuaranteesEditTest extends TestCase
{
    /**
     * Попытка изменить гарантию без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $guarantee = GuaranteeLegalEntity::query()
            ->inRandomOrder()->first();
        $this->get(route('admin.editGuaranteeLE', ['guarantee' => $guarantee]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * Попытка изменить гарантию под простым пользователем
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $guarantee = GuaranteeLegalEntity::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editGuaranteeLE', ['guarantee' => $guarantee]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     * Можем изменить гарантию если мы мэнеджер или админ
     *
     * @return void
     */
    public function testMainTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $guarantee = GuaranteeLegalEntity::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.editGuaranteeLE', ['guarantee' => $guarantee]))
            ->assertStatus(200)
            ->assertSeeText("Изменение данных поручительства")
            ->assertSeeText("Компания-гарант")
            ->assertSeeText("Срок действия")
            ->assertSeeText("Реальная дата закрытия")
            ->assertSeeText("Комментарий")
        ->assertSeeText($guarantee->guarantor->name)
        ->assertSeeText($guarantee->description)
        ->assertSeeText("Изменить")
        ->assertDontSeeText("Добавить");
    }


}
