<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\CompaniesDataservice;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.companies', CompaniesDataservice::provideData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $company = new Company();
        if (!empty($request->old())) {
            $company->fill($request->old());
        }
        return view('Admin.company-edit', [
            'company' => $company,
            'route' => 'admin.addCompany',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request): \Illuminate\Http\RedirectResponse
    {
        $company = new Company();
        $company->fill($request->all())->save();
        session()->flash('message', 'Добавлена новая компания группы');
        return redirect()->route('admin.companies');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return void
     */
    public function show(Company $company)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param Company $company
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Company $company): \Illuminate\Contracts\View\View
    {
        if (!empty($request->old())) {
            $company->fill($request->old());
        }
        return view('Admin.company-edit', [
            'company' => $company,
            'route' => 'admin.editCompany',
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param CompanyRequest $request
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyRequest $request, Company $company): \Illuminate\Http\RedirectResponse
    {

        $company->fill($request->all())->save();
        session()->flash('message', 'Информауия о компании изменена');
        return redirect()->route('admin.companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();
        session()->flash('message', 'Информация о компании удалена');
        return redirect()->route('admin.companies');
    }
}
