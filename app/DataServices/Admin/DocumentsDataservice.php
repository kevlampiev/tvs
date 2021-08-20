<?php


namespace App\DataServices\Admin;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DocumentsDataservice
{
    public static function provideDataVehicle(Vehicle $vehicle): array
    {
        $data = Document::query()->where('vehicle_id','=', $vehicle->id)
            ->with('user')
            ->get();

        return $data;
    }

    public static function create(Request $request):Document
    {
        $document = new Document();
        if (!empty($request->old())) $document->fill($request->old());
            else $document->fill($request->all());
        return $document;
    }

    public static function edit(Request $request, Document $document)
    {
        if (!empty($request->old())) $document->fill($request->old());
    }

    public static function saveChanges(DocumentRequest $request, Document $document)
    {
        $document->fill($request->except(['document_file']));
        if ($document->id) $document->updated_at = now();
        else $document->created_at = now();
        if ($request->file('document_file')) {
            $file_path = $request->file('document_file')->store(config('paths.documents.put', '/public/documents'));
            $document->file_name = basename($file_path);
        }
        $document->save();
    }

    public static function store(DocumentRequest $request)
    {
        try {
            $document = new Document();
            self::saveChanges($request, $document);
            session()->flash('message','Добавлен новый документ');
        } catch (Error $err) {
            session()->flash('error','Не удалось добавить новый документ');
        }

    }

    public static function update(DocumentRequest $request, Document $document)
    {
        try {
            self::saveChanges($request, $document);
            session()->flash('message','Данные документа обновлены');
        } catch (Error $err) {
            session()->flash('error','Не удалось обновить данные документа');
        }
    }

    //TODO Надо еще и файл удалать при удалении записи о нем
    public static function delete(Document $document)
    {
        try {
            $document->delete();
            session()->flash('message','Документ удален');
        } catch (Error $err) {
            session()->flash('error','Не удалось удалить документ');
        }
    }

}
