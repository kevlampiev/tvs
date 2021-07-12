<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehicleTypesDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTypeRequest;
use App\Models\VehicleType;
use Illuminate\Http\Request;


class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('Admin.types',
            VehicleTypesDataservice::provideData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vehicleType = new VehicleType();
        if (!empty($request->old())) {
            $vehicleType->fill($request->old());
        }
        return view('Admin.type-edit', [
            'vehicleType' => $vehicleType,
            'route' => 'admin.addVehicleType',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VehicleTypeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VehicleTypeRequest $request):\Illuminate\Http\RedirectResponse
    {
        $type= new VehicleType();
        $type->fill($request->all())->save();
        session()->flash('message', 'Добавлен новый тип техники');
        return redirect()->route('admin.vehicleTypes');
    }

    /**
     * Display the specified resource.
     *
     * @param VehicleType $type
     * @return void
     */
    public function show(VehicleType $type)
    {
//        if (!empty($request->old())) {
//            $type->fill($request->old());
//        }
//        return view('Admin.type-edit', [
//            'type' => $type,
//            'route' => 'admin.editType',
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param VehicleTypeRequest $request
     * @param VehicleType $type
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(VehicleTypeRequest $request, VehicleType $vehicleType):\Illuminate\Contracts\View\View
    {
        if (!empty($request->old())) {
            $vehicleType->fill($request->old());
        }
        return view('Admin.type-edit', [
            'vehicleType' => $vehicleType,
            'route' => 'admin.editVehicleType',
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param VehicleTypeRequest $request
     * @param VehicleType $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VehicleTypeRequest $request, VehicleType $vehicleType):\Illuminate\Http\RedirectResponse
    {

        $vehicleType->fill($request->all())->save();
        session()->flash('message','Тип техники изменен');
        return redirect()->route('admin.vehicleTypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VehicleType $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();
        session()->flash('message','Тип техники удален');
        return redirect()->route('admin.vehicleTypes');
    }
}
