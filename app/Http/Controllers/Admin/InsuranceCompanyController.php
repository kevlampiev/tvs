<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\InsuranceCompaniesDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceCompanyRequest;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.insurance-companies', InsuranceCompaniesDataservice::provideData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $insuranceCompany = new InsuranceCompany();
        if (!empty($request->old())) {
            $insuranceCompany->fill($request->old());
        }
        return view('Admin.insurance-company-edit', [
            'insuranceCompany' => $insuranceCompany,
            'route' => 'admin.addInsuranceCompany',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InsuranceCompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InsuranceCompanyRequest $request): \Illuminate\Http\RedirectResponse
    {
        $insuranceCompany = new InsuranceCompany();
        $insuranceCompany->fill($request->all())->save();
        session()->flash('message', 'Добавлена новая страхования компания');
        return redirect()->route('admin.insuranceCompanies');
    }

    /**
     * Display the specified resource.
     *
     * @param InsuranceCompany $insuranceCompany
     * @return void
     */
    public function show(InsuranceCompany $insuranceCompany)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param InsuranceCompany $insuranceCompany
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, InsuranceCompany $insuranceCompany): \Illuminate\Contracts\View\View
    {
        if (!empty($request->old())) {
            $insuranceCompany->fill($request->old());
        }
        return view('Admin.insurance-company-edit', [
            'insuranceCompany' => $insuranceCompany,
            'route' => 'admin.editInsuranceCompany',
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param InsuranceCompanyRequest $request
     * @param InsuranceCompany $insuranceCompany
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InsuranceCompanyRequest $request, InsuranceCompany $insuranceCompany): \Illuminate\Http\RedirectResponse
    {
        $insuranceCompany->fill($request->all())->save();
        session()->flash('message', 'Информация о страховой компании изменена');
        return redirect()->route('admin.insuranceCompanies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InsuranceCompany $insuranceCompany
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(InsuranceCompany $insuranceCompany): \Illuminate\Http\RedirectResponse
    {
        $insuranceCompany->delete();
        session()->flash('message', 'Информация о страховой компании удалена');
        return redirect()->route('admin.insuranceCompanies');
    }


}
