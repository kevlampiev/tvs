<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\DocumentsDataservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{


    public function create(Request $request, Vehicle $vehicle = null)
    {
        $Document = DocumentsDataservice::create($request, $vehicle);
        if (url()->previous()!==url()->current()) session(['previous_url'=>$this->previousUrl()]);
        return view('Admin.Document-edit',
            DocumentsDataservice::provideDocumentEditor($Document, 'admin.addDocument'));
    }

    public function store(DocumentRequest $request)
    {
        DocumentsDataservice::store($request);
        $route = session('previous_url', route('admin.Documents'));
        return redirect()->to($route);
    }


    public function edit(Request $request, Document $Document) {
        if (url()->previous()!==url()->current()) session(['previous_url'=>$this->previousUrl()]);
        DocumentsDataservice::edit($request, $Document);
        return view('Admin.Document-edit',
            DocumentsDataservice::provideDocumentEditor($Document,'admin.editDocument'));
    }

    public function update(DocumentRequest $request, Document $Document)
    {
        DocumentsDataservice::update($request, $Document);
        $route = session('previous_url', route('admin.Documents'));
        return redirect()->to($route);
    }

    public function delete(Document $Document): \Illuminate\Http\RedirectResponse
    {
        DocumentsDataservice::delete($Document);
        $route = session('previous_url', route('admin.Documents'));
        return redirect()->to($route);
    }


}
