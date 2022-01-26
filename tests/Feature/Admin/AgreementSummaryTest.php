<?php

namespace Tests\Feature\Admin;


use App\Models\Agreement;
use App\Models\AgreementNote;
use App\Models\Document;
use App\Models\User;
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
        if ($agreement->payments->count() > 0) {
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
        $document = Document::query()->where('agreement_id', '<>', null)->inRandomOrder()->first();
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
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();

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
        $document = Document::query()->where('agreement_id', '<>', null)
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
        $document = Document::query()->where('agreement_id', '<>', null)
            ->inRandomOrder()->first();
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.editAgreementDocument', ['document' => $document]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Проверяем, что менеджер может открыть страницу добавления нового документа
     *
     * @return void
     */

    public function testAddDocumentAsManager()
    {
        $agreement = Agreement::query()->inRandomOrder()->first();
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.addAgreementDocument', ['agreement' => $agreement]))
            ->assertStatus(200)
            ->assertSeeText('Добавить новый документ')
            ->assertSee($agreement->name)
            ->assertSee($agreement->agr_number)
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Загрузить новый файл документа');
    }

    /**
     *Проверяем, что менеджер может открыть страницу изменения нового документа
     *
     * @return void
     */

    public function testEditDocumentAsManager()
    {
        $document = Document::query()->where('agreement_id', '<>', null)
            ->inRandomOrder()->first();
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.editAgreementDocument', ['document' => $document]))
            ->assertStatus(200)
            ->assertSeeText('Изменение данных')
            ->assertSee($document->description)
            ->assertSee($document->agreement->agr_number)
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена')
            ->assertSeeText('Загрузить новый файл документа');
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------

    /**
     * Смотрим на страницу notes
     *
     * @return void
     */
    public function testNotesTab()
    {
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();
        $note = AgreementNote::query()->where('agreement_id', '<>', null)->inRandomOrder()->first();
        $agreement = Agreement::find($note->agreement_id);


        $response = $this->actingAs($user)
            ->get(route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'notes']))
            ->assertStatus(200)
            ->assertSeeText($agreement->agr_number)
            ->assertSeeText('Заметки по догору')
            ->assertSeeText('Добавить заметку')
            ->assertSeeText($note->note_body)
            ->assertSeeText($note->user->name);
    }

    /**
     *Проверяем, что невозможно открыть страницу добавления новой заметки по договору неавторизованному
     *пользователю
     *
     * @return void
     */

    public function testAddNoteUnauthorized()
    {
        $agreement = Agreement::query()->inRandomOrder()->first();

        $response = $this->get(route('admin.addAgreementNote', ['agreement' => $agreement]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     *Проверяем, что невозможно открыть страницу добавления новой заметки по договору простому пользователю
     *
     * @return void
     */

    public function testAddNoteAsUser()
    {
        $agreement = Agreement::query()->inRandomOrder()->first();
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.addAgreementNote', ['agreement' => $agreement]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Проверяем, что невозможно открыть страницу изменения заметки по договору неавторизованному
     *пользователю
     *
     * @return void
     */

    public function testEditNoteUnauthorized()
    {
        $note = AgreementNote::query()->inRandomOrder()->first();

        $response = $this->get(route('admin.editAgreementNote', ['agreementNote' => $note]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     *Проверяем, что невозможно открыть страницу заметки по договору простому пользователю
     *
     * @return void
     */

    public function testEditNoteAsUser()
    {
        $note = AgreementNote::query()->inRandomOrder()->first();
        $user = User::query()->where('role', '=', 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.editAgreementNote', ['agreementNote' => $note]))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /**
     *Проверяем, что менеджер может открыть страницу добавления новой заметки к договору
     *
     * @return void
     */

    public function testAddNoteAsManager()
    {
        $agreement = Agreement::query()->inRandomOrder()->first();
        $user = User::query()->where('role', '<>', 'user')->inRandomOrder()->first();

        $response = $this->actingAs($user)
            ->get(route('admin.addAgreementNote', ['agreement' => $agreement]))
            ->assertStatus(200)
            ->assertSeeText('Добавить заметку')
            ->assertSeeText('Договор')
            ->assertSeeText('Текст заметки')
            ->assertSee($agreement->name)
            ->assertSeeText('Добавить')
            ->assertSeeText('Отмена');
    }

    /**
     *Проверяем, что создатель заметки может открыть страницу изменения заметки по договору
     *
     * @return void
     */

    public function testEditNoteAsManager()
    {
        $note = AgreementNote::query()->inRandomOrder()->first();
        $user = $note->user;

        $response = $this->actingAs($user)
            ->get(route('admin.editAgreementNote', ['agreementNote' => $note]))
            ->assertStatus(200)
            ->assertSeeText('Редактирование заметки')
            ->assertSee($note->agreement->name)
            ->assertSee($note->note_body)
            ->assertSeeText('Изменить')
            ->assertSeeText('Отмена');
    }


}
