<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\AgreementNotesDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgreementNoteRequest;
use App\Models\Agreement;
use App\Models\AgreementNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AgreementNoteController extends Controller
{
    public function create(Request $request, Agreement $agreement)
    {
        $agreementNote = new AgreementNote();
        $agreementNote->agreement_id = $agreement->id;
        if (!empty($request->old())) $agreementNote->fill($request->old());
        return view('Admin.agreement-note-edit', AgreementNotesDataservice::provideEditor($agreementNote));
    }

    public function store(AgreementNoteRequest $request, Agreement $agreement): RedirectResponse
    {
        AgreementNotesDataservice::storeNew($request);
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'notes']);
    }

    public function edit(Request $request, AgreementNote $agreementNote)
    {
        if (!empty($request->old())) $agreementNote->fill($request->old());
        return view('Admin.agreement-note-edit', AgreementNotesDataservice::provideEditor($agreementNote));
    }

    public function update(AgreementNoteRequest $request, AgreementNote $agreementNote): RedirectResponse
    {
        AgreementNotesDataservice::update($request, $agreementNote);
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreementNote->agreement, 'page' => 'notes']);
    }

    public function erase(AgreementNote $agreementNote): RedirectResponse
    {
        $agreementId = $agreementNote->agreement->id;
        AgreementNotesDataservice::erase($agreementNote);
        return redirect()->route('admin.agreementSummary', ['agreement' => $agreementId, 'page' => 'notes']);
    }


}
