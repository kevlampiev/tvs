<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgreementType;
use Illuminate\Http\Request;

class AgreementTypeController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.agreement-types', ['agrTypes' => AgreementType::withCount('agreements')->get()]);
    }

    public function addType(Request $request)
    {
        $type = new AgreementType();
        if ($request->isMethod('post')) {
            $this->validate($request, AgreementType::rules());
            $type->fill($request->only('name'));
            $type->save();
            return redirect()->route('admin.agrTypes');
        } else {
            if (!empty($request->old())) {
                $type->fill($request->old());
            }
            return view('Admin/agreement-type-edit', [
                'agrType' => $type,
                'route' => 'admin.addAgrType',
            ]);
        }
    }

    public function editType(Request $request, AgreementType $agrType)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, AgreementType::rules());
            $agrType->fill($request->only('name'));
            $agrType->save();
            return redirect()->route('admin.agrTypes');
        } else {
            return view('Admin/agreement-type-edit', [
                'agrType' => $agrType,
                'route' => 'admin.editAgrType',
            ]);
        }
    }

    public function deleteType(AgreementType $agrType)
    {
        $agrType->delete();
        return redirect()->route('admin.agrTypes');
    }
}
