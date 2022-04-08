<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\GuaranteesLegalEntitysDataService;
use App\DataServices\Admin\POADataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuaranteeLegalEntityRequest;
use App\Http\Requests\PowerOfAttorneyRequest;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\GuaranteeLegalEntity;
use App\Models\PowerOfAttorney;
use Illuminate\Http\Request;

class GuaranteeLegalEntityController extends Controller
{
    public function create(Request $request, Agreement $agreement)
    {
        $guarantee = GuaranteesLegalEntitysDataService::create($request, $agreement);
        return view('Admin.guarantees-legal-entity.guarantee-edit',
            GuaranteesLegalEntitysDataService::provideEditor($guarantee));
    }

    public function store(GuaranteeLegalEntityRequest $request)
    {
        GuaranteesLegalEntitysDataService::store($request);
        return redirect()->route('admin.agreementSummary' ,
            ['agreement' => $request->get('agreement_id'),
                'page' => 'guarantees']);
    }

    public function edit(Request $request, GuaranteeLegalEntity $guarantee)
    {
        if (!empty($request->old())) $guarantee->fill($request->old());
        return view('Admin.guarantees-legal-entity.guarantee-edit',
            GuaranteesLegalEntitysDataService::provideEditor($guarantee));
    }

    public function update(GuaranteeLegalEntityRequest $request, GuaranteeLegalEntity $guarantee)
    {
        GuaranteesLegalEntitysDataService::update($request, $guarantee);
        return redirect()->route('admin.agreementSummary' ,
            ['agreement' => $request->get('agreement_id'),
                'page' => 'guarantees']);
    }

    public function erase(GuaranteeLegalEntity $guarantee)
    {
        GuaranteesLegalEntitysDataService::delete($guarantee);
        return redirect()->back();
    }


}
