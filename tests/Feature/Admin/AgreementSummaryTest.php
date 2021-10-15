<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\AgreementNote;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AgreementSummaryTest extends TestCase
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
        $this->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'vehicles']))
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
            ->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'vehicles']))
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
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();

        $this->actingAs($user)
            ->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'main']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number)
            ->assertSeeText($agreement->agreementType->name)
            ->assertSeeText($agreement->company->name)
            ->assertSeeText($agreement->counterparty->name);
    }


    /**
     * Смотрим на страницу vehicles
     *
     * @return void
     */
    public function testVehiclesTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'vehicles']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number);
        if ($agreement->vehicles->count() !== 0) {
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
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $agreement = Agreement::query()
            ->with('payments')
            ->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number)
            ->assertSeeText('Платежи в соответствии с договором')
            ->assertSeeText('Новый платеж')
            ->assertSeeText('Добавить серию платежей')
            ->assertSeeText('Реальные оплаты');
        if ($agreement->payments->count()>0) {
            $response->assertSeeText('Удалить все платеж');
        } else {
            $response->assertDontSeeText('Удалить все платеж');
        }
    }

    /**
     * Смотрим на страницу documents
     *
     * @return void
     */
    public function testDocumentsTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $document = Document::query()->where('agreement_id','<>',null)->inRandomOrder()->first();
        $agreement = Agreement::find($document->agreement_id);


        $response = $this->actingAs($user)
            ->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'documents']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number)
            ->assertSeeText('Связанные файлы')
            ->assertSeeText('Добавить документ')
            ->assertSeeText($document->name);
    }

    /**
     * Смотрим на страницу notes
     *
     * @return void
     */
    public function testNotesTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $note = AgreementNote::query()->where('agreement_id','<>',null)->inRandomOrder()->first();
        $agreement = Agreement::find($note->agreement_id);


        $response = $this->actingAs($user)
            ->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'notes']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number)
            ->assertSeeText('Заметки по догору')
            ->assertSeeText('Добавить заметку')
            ->assertSeeText($note->note_body)
            ->assertSeeText($note->user->name)
        ;
    }

    /**
     *Проверяем, что невозможно открыть страницу добавления нового документа по договору неавторизованному
     *пользователю
     *
     * @return void
     */

    public function testAddDocumentUnauthorized()
    {
        $agreement = Agreement::query()->inRandomOrder()->first();

        $response = $this->get(route('admin.addAgreementDocument', ['agreement' => $agreement]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     *Проверяем, что невозможно открыть страницу добавления нового документа по договору простому
     *пользователю
     *
     * @return void
     */

    public function testAddDocumentAsUser()
    {
        $agreement = Agreement::query()->inRandomOrder()->first();
        $user = User::query()->where('role','=' , 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.addAgreementDocument', ['agreement' => $agreement]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

   /**
     *Проверяем, что невозможно открыть страницу изменения документа по договору неавторизованному
     *пользователю
     *
     * @return void
     */

    public function testEditDocumentUnauthorized()
    {
        $document = Document::query()->where('agreement_id','<>', null)
            ->inRandomOrder()->first();

        $response = $this->get(route('admin.editAgreementDocument', ['document' => $document]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     *Проверяем, что невозможно открыть страницу изменения документа по договору простому пользователю
     *
     * @return void
     */

    public function testEditDocumentAsUser()
    {
        $document = Document::query()->where('agreement_id','<>', null)
            ->inRandomOrder()->first();
        $user = User::query()->where('role','=' , 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.editAgreementDocument', ['document' => $document]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }


}
