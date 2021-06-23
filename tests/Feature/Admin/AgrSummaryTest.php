<?php

namespace Tests\Feature;


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
//        $agreement = Agreement::query()
//            ->with('payments')
//            ->inRandomOrder()->get();
//        dd($agreement);
//        $this->get(route('admin.agreementSummary', [ 'agreement' => $agreement, 'page'=>'vehicles']))
//            ->assertStatus(302)
//            ->assertRedirect(route('login'));
    }


}
