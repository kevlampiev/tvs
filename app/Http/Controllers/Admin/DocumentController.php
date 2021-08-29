<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\DocumentsDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
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

    public function create(Request $request, Vehicle $vehicle)
    {
        $params = [
            'vehicle_id' => $vehicle->id
        ];
        $Document = DocumentsDataservice::create($request, $params);
        if (url()->previous() !== url()->current()) session(['previous_url' => $this->previousUrl()]);
        return view('Admin.document-edit',
            DocumentsDataservice::provideDocumentEditor($Document, 'admin.addDocument'));
    }

    public function store(DocumentRequest $request)
    {
        DocumentsDataservice::store($request);
        $route = session('previous_url');
        return redirect()->to($route);
    }


    public function edit(Request $request, Document $Document)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => $this->previousUrl()]);
        DocumentsDataservice::edit($request, $Document);
        return view('Admin.document-edit',
            DocumentsDataservice::provideDocumentEditor($Document, 'admin.editDocument'));
    }

    public function update(DocumentRequest $request, Document $Document)
    {
        DocumentsDataservice::update($request, $Document);
        $route = session('previous_url');
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
        $route = session('previous_url');
        return redirect()->to($route);
    }


}
