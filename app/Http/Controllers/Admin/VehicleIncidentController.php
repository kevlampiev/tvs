<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehicleIncidentDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleIncidentRequest;
use App\Models\Vehicle;
use App\Models\VehicleIncident;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VehicleIncidentController extends Controller
{
    public function create(Request $request, Vehicle $vehicle)
    {
        $vehicleIncident = new VehicleIncident();
        $vehicleIncident->vehicle_id = $vehicle->id;
        $vehicleIncident->date_open = Carbon::now()->toDateString();
        if (!empty($request->old())) $vehicleIncident->fill($request->old());
        return view('Admin.vehicles.vehicle-incident-edit', VehicleIncidentDataservice::provideEditor($vehicleIncident));
    }

    public function store(VehicleIncidentRequest $request, Vehicle $vehicle): \Illuminate\Http\RedirectResponse
    {
        VehicleIncidentDataservice::storeNew($request);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'incidents']);
    }

    public function edit(Request $request, VehicleIncident $vehicleIncident)
    {
        if (!empty($request->old())) $vehicleIncident->fill($request->old());
        return view('Admin.vehicles.vehicle-incident-edit', VehicleIncidentDataservice::provideEditor($vehicleIncident));
    }

    public function update(VehicleIncidentRequest $request, VehicleIncident $vehicleIncident): RedirectResponse
    {
        VehicleIncidentDataservice::update($request, $vehicleIncident);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicleIncident->vehicle, 'page' => 'incidents']);
    }

    public function erase(VehicleIncident $vehicleIncident): RedirectResponse
    {
        $vehicleId = $vehicleIncident->vehicle->id;
        VehicleIncidentDataservice::erase($vehicleIncident);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicleId, 'page' => 'incidents']);
    }

}
