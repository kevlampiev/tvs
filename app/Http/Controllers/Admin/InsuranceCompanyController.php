<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.insurance-companies', ['companies' => InsuranceCompany::query()->orderBy('name')->get(), 'filter' => '']);
    }

    public function add(Request $request)
    {
        $company = new InsuranceCompany();
        if ($request->isMethod('post')) {
            $this->validate($request, InsuranceCompany::rules());
            $company->fill($request->only(['name']));
            $company->save();
            return redirect()->route('admin.insuranceCompanies');
        } else {
            if (!empty($request->old())) {
                $company->fill($request->old());
            }
            return view('Admin/insurance-company-edit', [
                'company' => $company,
                'route' => 'admin.addInsuranceCompany',
            ]);
        }
    }

    public function edit(Request $request, InsuranceCompany $company)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, InsuranceCompany::rules());
            $company->fill($request->only(['name']));
            $company->save();
            return redirect()->route('admin.insuranceCompanies');
        } else {
            if (!empty($request->old())) {
                $company->fill($request->old());
            }
            return view('Admin/insurance-company-edit', [
                'company' => $company,
                'route' => 'admin.editInsuranceCompany',
            ]);
        }
    }

    public function delete(InsuranceCompany $company): \Illuminate\Http\RedirectResponse
    {
        $company->delete();
        return redirect()->route('admin.insuranceCompanies');
    }

}
