<?php


namespace App\DataServices\Admin;

use App\Http\Requests\DocumentAddRequest;
use App\Http\Requests\DocumentEditRequest;
use App\Models\Agreement;
use App\Models\Document;
use App\Models\Insurance;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentsDataservice
{
    public static function provideDataVehicle(Vehicle $vehicle): array
    {
        $data = Document::query()->where('vehicle_id', '=', $vehicle->id)
            ->with('user')
            ->get();

        return $data;
    }

    public static function provideDocumentEditor(Document $document, $route = null): array
    {
        return [
            'document' => $document,
            'insurances' => Insurance::all(),
            'vehicles' => Vehicle::all(),
            'agreements' => Agreement::all(),
            'route' => $route
        ];
    }


    /**
     * params - массив со списклм внешних ключей и их значений, к которым должен быть привяхан документ
     * returns Document
     */
    public static function create(Request $request, array $params = []): Document
    {
        $document = new Document();
        if (!empty($request->old())) $document->fill($request->old());
        else $document->fill($params);
        return $document;
    }

    public static function edit(Request $request, Document $document)
    {
        if (!empty($request->old())) $document->fill($request->old());
    }

    public static function saveChanges(Request $request, Document $document)
    {
        $document->fill($request->except(['document_file']));
        if (!$document->user_id) $document->user_id = Auth::user()->id;
        if ($document->id) $document->updated_at = now();
        else $document->created_at = now();
        if ($request->file('document_file')) {
            Storage::delete('public/documents/'.$document->file_name);
            $file_path = $request->file('document_file')->store(config('paths.documents.put', '/public/documents'));
            $document->file_name = basename($file_path);
        }
        $document->save();
    }

    public static function store(DocumentAddRequest $request)
    {
        try {
            $document = new Document();
            self::saveChanges($request, $document);
            session()->flash('message', 'Добавлен новый документ');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новый документ');
        }

    }

    public static function update(DocumentEditRequest $request, Document $document)
    {
        try {
            self::saveChanges($request, $document);
            session()->flash('message', 'Данные документа обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные документа');
        }
    }

    public static function delete(Document $document)
    {
        try {
            Storage::delete('public/documents/'.$document->file_name);
            $document->delete();
            session()->flash('message', 'Документ удален');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить документ');
        }
    }

}
