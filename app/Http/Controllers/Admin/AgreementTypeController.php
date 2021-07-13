<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\AgreementTypesDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgreementTypeRequest;
use App\Models\AgreementType;
use Illuminate\Http\Request;

class AgreementTypeController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.agreement-types', AgreementTypesDataservice::provideData());
    }

//    public function addType(Request $request)
//    {
//        $type = new AgreementType();
//        if ($request->isMethod('post')) {
//            $this->validate($request, AgreementType::rules());
//            $type->fill($request->only('name'));
//            $type->save();
//            return redirect()->route('admin.agrTypes');
//        } else {
//            if (!empty($request->old())) {
//                $type->fill($request->old());
//            }
//            return view('Admin/agreement-type-edit', [
//                'agrType' => $type,
//                'route' => 'admin.addAgrType',
//            ]);
//        }
//    }
//
//    public function editType(Request $request, AgreementType $agrType)
//    {
//        if ($request->isMethod('post')) {
//            $this->validate($request, AgreementType::rules());
//            $agrType->fill($request->only('name'));
//            $agrType->save();
//            return redirect()->route('admin.agrTypes');
//        } else {
//            return view('Admin/agreement-type-edit', [
//                'agrType' => $agrType,
//                'route' => 'admin.editAgrType',
//            ]);
//        }
//    }
//
//    public function deleteType(AgreementType $agrType)
//    {
//        $agrType->delete();
//        return redirect()->route('admin.agrTypes');
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $agrType = new AgreementType();
        if (!empty($request->old())) {
            $agrType->fill($request->old());
        }
        return view('Admin.agreement-type-edit', [
            'agrType' => $agrType,
            'route' => 'admin.addAgrType',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AgreementTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AgreementTypeRequest $request): \Illuminate\Http\RedirectResponse
    {
        $agrType = new AgreementType();
        $agrType->fill($request->all())->save();
        session()->flash('message', 'Добавлен новый тип договоров');
        return redirect()->route('admin.agrTypes');
    }

    /**
     * Display the specified resource.
     *
     * @param AgreementType $agreementType
     * @return void
     */
    public function show(AgreementType $agreementType)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param AgreementType $agrType
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, AgreementType $agrType): \Illuminate\Contracts\View\View
    {
        if (!empty($request->old())) {
            $agrType->fill($request->old());
        }
        return view('Admin.agreement-type-edit', [
            'agrType' => $agrType,
            'route' => 'admin.editAgrType',
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param AgreementTypeRequest $request
     * @param AgreementType $agrType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgreementTypeRequest $request, AgreementType $agrType): \Illuminate\Http\RedirectResponse
    {
        $agrType->fill($request->all())->save();
        session()->flash('message', 'Информация о типе договора изменена');
        return redirect()->route('admin.agrTypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AgreementType $agrType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AgreementType $agrType): \Illuminate\Http\RedirectResponse
    {
        $agrType->delete();
        session()->flash('message', 'Информация о пите договора удалена');
        return redirect()->route('admin.agrTypes');
    }


}
