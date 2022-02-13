<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\DocumentsDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentAddRequest;
use App\Http\Requests\DocumentEditRequest;
use App\Models\Agreement;
use App\Models\Document;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DocumentController extends Controller
{


    private function previousUrl(): string
    {
        $route = url()->previous();
        if (preg_match('/.{1,}summary$/i', $route)) $route .= '/documents';
        return $route;
    }

    private function storeUrl(int $vehicle = null, int $agreement = null)
    {
        if ($vehicle) {
            session(['previous_url' => route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'documents'])]);
        } else {
            session(['previous_url' => route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'documents'])]);
        }
    }

    public function create(Request $request, Vehicle $vehicle, Agreement $agreement)
    {
        $Document = DocumentsDataservice::create($request,
            [
                'vehicle_id' => $vehicle->id ?? null,
                'agreement_id' => $agreement->id ?? null,
            ]);
//        $this->storeUrl($vehicle->id, $agreement->id);
        if (url()->current() != url()->previous()) session(['previous_url' => url()->previous()]);
        return view('Admin.document-edit',
            DocumentsDataservice::provideDocumentEditor($Document, 'admin.addDocument'));
    }

    public function store(DocumentAddRequest $request)
    {
        DocumentsDataservice::store($request);
        $route = session()->pull('previous_url');
        return redirect()->to($route);
    }


    public function edit(Request $request, Document $document)
    {
//        $this->storeUrl($document->vehicle_id, $document->agreement_id);
        if (url()->current() != url()->previous()) session(['previous_url' => url()->previous()]);
        DocumentsDataservice::edit($request, $document);
        return view('Admin.document-edit',
            DocumentsDataservice::provideDocumentEditor($document, 'admin.editVehicleDocument'));
    }

    //Используется другой Request, подразумевается что файл уже есть на диске,
    // проверять его присутсвие в форме не обязательно
    public function update(DocumentEditRequest $request, Document $Document)
    {
        DocumentsDataservice::update($request, $Document);
        $route = session()->pull('previous_url');
        return redirect()->to($route);
    }

    public function preview(Document $document)
    {
        $filename = storage_path('app/public/documents/' . $document->file_name);
        return response()->file($filename);
    }

    public function delete(Document $Document): \Illuminate\Http\RedirectResponse
    {
        DocumentsDataservice::delete($Document);
//        $route = session()->pull('previous_url');
        return redirect()->back();
    }


}
