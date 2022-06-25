<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehicleLocationsDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgreementTypeRequest;
use App\Models\AgreementType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AgreementTypeController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.agreement-types', VehicleLocationsDataservice::provideData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
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
     * @return RedirectResponse
     */
    public function store(AgreementTypeRequest $request): RedirectResponse
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
     * @return View
     */
    public function edit(Request $request, AgreementType $agrType): View
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
     * @return RedirectResponse
     */
    public function update(AgreementTypeRequest $request, AgreementType $agrType): RedirectResponse
    {
        $agrType->fill($request->all())->save();
        session()->flash('message', 'Информация о типе договора изменена');
        return redirect()->route('admin.agrTypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AgreementType $agrType
     * @return RedirectResponse
     */
    public function destroy(AgreementType $agrType): RedirectResponse
    {
        $agrType->delete();
        session()->flash('message', 'Информация о пите договора удалена');
        return redirect()->route('admin.agrTypes');
    }


}
