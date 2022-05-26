<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehicleConditionDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleConditionRequest;
use App\Models\Vehicle;
use App\Models\VehicleCondition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VehicleConditionController extends Controller
{
    public function create(Request $request, Vehicle $vehicle)
    {
        $vehicleCondition = new VehicleCondition();
        $vehicleCondition->vehicle_id = $vehicle->id;
        $vehicleCondition->getConnection = "operable";
        $vehicleCondition->date_open = Carbon::now()->toDateString();
        if (!empty($request->old())) $vehicleCondition->fill($request->old());
        return view('Admin.vehicles.vehicle-condition-edit', VehicleConditionDataservice::provideEditor($vehicleCondition));
    }

    public function store(VehicleConditionRequest $request, Vehicle $vehicle): \Illuminate\Http\RedirectResponse
    {
        VehicleConditionDataservice::storeNew($request);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'conditions']);
    }

    public function edit(Request $request, VehicleCondition $vehicleCondition)
    {
        if (!empty($request->old())) $vehicleCondition->fill($request->old());
        return view('Admin.vehicles.vehicle-condition-edit', VehicleConditionDataservice::provideEditor($vehicleCondition));
    }

    public function update(VehicleConditionRequest $request, VehicleCondition $vehicleCondition): RedirectResponse
    {
        VehicleConditionDataservice::update($request, $vehicleCondition);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicleCondition->vehicle, 'page' => 'conditions']);
    }

    public function erase(VehicleCondition $vehicleCondition): RedirectResponse
    {
        $vehicleId = $vehicleCondition->vehicle->id;
        VehicleConditionDataservice::erase($vehicleCondition);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicleId, 'page' => 'conditions']);
    }

}
