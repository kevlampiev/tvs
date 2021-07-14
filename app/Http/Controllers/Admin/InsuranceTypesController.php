<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\InsuranceTypesDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceTypeRequest;
use App\Models\InsuranceType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InsuranceTypesController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.insurance-types',
            InsuranceTypesDataservice::provideData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $insuranceType = new InsuranceType();
        if (!empty($request->old())) {
            $insuranceType->fill($request->old());
        }
        return view('Admin.insurance-type-edit', [
            'insuranceType' => $insuranceType,
            'route' => 'admin.addInsuranceType',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InsuranceTypeRequest $request
     * @return RedirectResponse
     */
    public function store(InsuranceTypeRequest $request): RedirectResponse
    {
        $insuranceType = new InsuranceType();
        $insuranceType->fill($request->all())->save();
        session()->flash('message', 'Добавлен новый тип страхования');
        return redirect()->route('admin.insuranceTypes');
    }

    /**
     * Display the specified resource.
     *
     * @param InsuranceType $insuranceType
     * @return void
     */
    public function show(InsuranceType $insuranceType)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param InsuranceType $insuranceType
     * @return View
     */
    public function edit(Request $request, InsuranceType $insuranceType): View
    {
        if (!empty($request->old())) {
            $insuranceType->fill($request->old());
        }
        return view('Admin.insurance-type-edit', [
            'insuranceType' => $insuranceType,
            'route' => 'admin.editInsuranceType',
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param InsuranceTypeRequest $request
     * @param InsuranceType $insuranceType
     * @return RedirectResponse
     */
    public function update(InsuranceTypeRequest $request, InsuranceType $insuranceType): RedirectResponse
    {
        $insuranceType->fill($request->all())->save();
        session()->flash('message', 'Информация о типе страховки изменена');
        return redirect()->route('admin.insuranceTypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InsuranceType $insuranceType
     * @return RedirectResponse
     */
    public function destroy(InsuranceType $insuranceType): RedirectResponse
    {
        $insuranceType->delete();
        session()->flash('message', 'Информация о типе страховки удалена');
        return redirect()->route('admin.insuranceTypes');
    }

}
