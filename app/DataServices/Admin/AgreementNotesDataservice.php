<?php


namespace App\DataServices\Admin;


use App\Http\Requests\AgreementNoteRequest;
use App\Models\AgreementNote;
use Illuminate\Support\Facades\Auth;
use PhpParser\Error;

class AgreementNotesDataservice
{
    public static function provideData(): array
    {
        return ['notes' => AgreementNote::all(), 'filter' => ''];
    }

    public static function provideEditor(AgreementNote $agreementNote): array
    {
        return ['agreementNote' => $agreementNote, 'route' => ($agreementNote->id) ? 'admin.editAgreementsNote' : 'admin.addAgreementNote'];
    }

    public static function storeNew(AgreementNoteRequest $request)
    {
        $note = new AgreementNote();
        self::saveChanges($request, $note);
    }

    public static function update(AgreementNoteRequest $request, AgreementNote $agreementNote)
    {
        self::saveChanges($request, $agreementNote);
    }

    public static function saveChanges(AgreementNoteRequest $request, AgreementNote $agreementNote)
    {
        $agreementNote->fill($request->except(['id', 'created_at', 'updated_at', 'agreement']));
        if (!$agreementNote->user_id) $agreementNote->user_id = Auth::user()->id;
        if ($agreementNote->id) $agreementNote->updated_at = now();
        else $agreementNote->created_at = now();

        try {
            $agreementNote->save();
            session()->flash('message', 'Данные заметки сохранены');
        } catch (Error $err) {
            session()->flash('error', 'Ошибка сохранения данных о заметке');
        }
    }

    public static function erase(AgreementNote $agreementNote)
    {
        try {
            $agreementNote->delete();
            session()->flash('message', 'Заметка удалена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить заметку');
        }
    }
}
