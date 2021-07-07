<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsuranceType;
use Illuminate\Http\Request;

class InsuranceTypesController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.insurance-types',
            ['insTypes' => InsuranceType::query()->orderBy('name')->get(), 'filter' => '']);
    }

    public function add(Request $request)
    {
        $type = new InsuranceType();
        if ($request->isMethod('post')) {
            $this->validate($request, InsuranceType::rules());
            $type->fill($request->only('name'));
            $type->save();
            return redirect()->route('admin.insTypes');
        } else {
            if (!empty($request->old())) {
                $type->fill($request->old());
            }
            return view('Admin/insurance-type-edit', [
                'insType' => $type,
                'route' => 'admin.addInsType',
            ]);
        }
    }

    public function edit(Request $request, InsuranceType $insType)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, InsuranceType::rules());
            $insType->fill($request->only('name'));
            $insType->save();
            return redirect()->route('admin.insTypes');
        } else {
            if (!empty($request->old())) {
                $insType->fill($request->old());
            }
            return view('Admin/insurance-type-edit', [
                'insType' => $insType,
                'route' => 'admin.editInsType',
            ]);
        }
    }

    public function delete(InsuranceType $insType)
    {
        $insType->delete();
        return redirect()->route('admin.insTypes');
    }
}
