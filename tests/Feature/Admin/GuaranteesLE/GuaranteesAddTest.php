<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\AgreementNote;
use App\Models\Document;
use App\Models\GuaranteeLegalEntity;
use App\Models\User;
use Tests\TestCase;

class GuaranteesAddTest extends TestCase
{
    /**
     * Попытка добавить гарантию без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $agreement = Agreement::query()
            ->inRandomOrder()->first();
        $this->get(route('admin.addGuaranteeLE', ['agreement' => $agreement]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * Попытка добавить гарантию под простым пользователем
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.addGuaranteeLE', ['agreement' => $agreement]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     * Можем добавить гарантию если мы мэнеджер или админ
     *
     * @return void
     */
    public function testMainTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $guarantee = GuaranteeLegalEntity::query()
            ->inRandomOrder()->first();
        $agreement = $guarantee->agreement;

        $this->actingAs($user)
            ->get(route('admin.addGuaranteeLE', ['agreement' => $agreement]))
            ->assertStatus(200)
            ->assertSeeText("Добавить новое поручительство по договору")
            ->assertSeeText("Компания-гарант")
            ->assertSeeText("Срок действия")
            ->assertSeeText("Реальная дата закрытия")
            ->assertSeeText("Комментарий");
    }


}
