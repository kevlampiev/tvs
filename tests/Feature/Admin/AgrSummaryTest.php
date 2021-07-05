<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AgrSummaryTest extends TestCase
{
    /**
     * Попытка зайти без авторизации
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();
        $this->get(route('admin.agreementSummary', [ 'agreement' => $agreement, 'page'=>'vehicles']))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * Попытка зайти под простым пользователем
     *
     * @return void
     */
    public function testAsUser()
    {
        $user = User::query()->where('role', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();
        $this->actingAs($user)
            ->get(route('admin.agreementSummary', [ 'agreement' => $agreement, 'page'=>'vehicles']))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     * Смотрим на главную страницу
     *
     * @return void
     */
    public function testMainTab()
    {
        $user = User::query()->where('role','<>', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();

        $this->actingAs($user)
            ->get(route('admin.agreementSummary', [ 'agreement' => $agreement, 'page'=>'main']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number)
            ->assertSeeText($agreement->agreementType->name)
            ->assertSeeText($agreement->company->name)
            ->assertSeeText($agreement->counterparty->name)
        ;
    }


    /**
     * Смотрим на страницу vehicles
     *
     * @return void
     */
    public function testVehiclesTab()
    {
        $user = User::query()->where('role','<>', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();

        $response= $this->actingAs($user)
            ->get(route('admin.agreementSummary', [ 'agreement' => $agreement, 'page'=>'vehicles']))
            ->assertStatus(200)
        ->assertSeeText($agreement->agr_number);
        if ($agreement->vehicles->count()!==0) {
            $response->assertSeeText('Удалить')
            ->assertSeeText($agreement->vehicles->first()->agr_name);
        }

    }

    /**
     * Смотрим на страницу vehicles
     *
     * @return void
     */
    public function testPaymentsTab()
    {
        $user = User::query()->where('role','<>', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();

        $response= $this->actingAs($user)
            ->get(route('admin.agreementSummary', [ 'agreement' => $agreement, 'page'=>'payments']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number)
            ->assertSeeText('Платежи в соответствии с договором')
            ->assertSeeText('Реальные оплаты');
    }

}
