<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\POADataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\PowerOfAttorneyRequest;
use App\Models\Company;
use App\Models\PowerOfAttorney;
use Illuminate\Http\Request;

class PowerOfAttorneyController extends Controller
{
    public function create(Request $request, Company $company)
    {
        $powerOfAttorney = POADataservice::create($request, $company);
        return view('Admin.companies.poa-edit', POADataservice::provideEditor($powerOfAttorney));
    }

    public function store(PowerOfAttorneyRequest $request)
    {
        POADataservice::store($request);
        return redirect()->route('admin.companySummary' ,
            ['company' => $request->get('company_id'),
                'page' => 'poas']);
    }

    public function edit(Request $request, PowerOfAttorney $powerOfAttorney)
    {
        if (!empty($request->old())) $powerOfAttorney->fill($request->old());
        return view('Admin.companies.poa-edit', POADataservice::provideEditor($powerOfAttorney));
    }

    public function update(PowerOfAttorneyRequest $request, PowerOfAttorney $powerOfAttorney)
    {
        POADataservice::update($request, $powerOfAttorney);
        return redirect()->route('admin.companySummary' ,
            ['company' => $request->get('company_id'),
                'page' => 'poas']);
    }

    public function erase(PowerOfAttorney $powerOfAttorney)
    {
        POADataservice::delete($powerOfAttorney);
        return redirect()->back();
    }


}
