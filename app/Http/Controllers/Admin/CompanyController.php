<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.companies', ['companies' => Company::withCount('agreements')->get(), 'filter' => '']);
    }

    public function addCompany(Request $request)
    {
        $company = new Company();
        if ($request->isMethod('post')) {
            $this->validate($request,Company::rules());
            $company->fill($request->only(['name', 'code']));
            $company->save();
            return redirect()->route('admin.companies');
        } else {
            if (!empty($request->old())) {
                $company->fill($request->old());
            }
            return view('Admin/company-edit', [
                'company' => $company,
                'route' => 'admin.addCompany',
            ]);
        }
    }

    public function editCompany(Request $request, Company $company)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,Company::rules());
            $company->fill($request->only(['name', 'code']));
            $company->save();
            return redirect()->route('admin.companies');
        } else {
            if (!empty($request->old())) {
                $company->fill($request->old());
            }
            return view('Admin/company-edit', [
                'company' => $company,
                'route' => 'admin.editCompany',
            ]);
        }
    }

    public function deleteCompany(Company $company): \Illuminate\Http\RedirectResponse
    {
        $company->delete();
        return redirect()->route('admin.companies');
    }
}
