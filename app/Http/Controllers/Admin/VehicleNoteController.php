<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehicleNotesDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleNoteRequest;
use App\Models\Vehicle;
use App\Models\VehicleNote;
use Illuminate\Http\Request;

class VehicleNoteController extends Controller
{
    public function create(Request $request, Vehicle $vehicle)
    {
        $vehicleNote = new VehicleNote();
        $vehicleNote->vehicle_id = $vehicle->id;
        if (!empty($request->old())) $vehicleNote->fill($request->old());
        return view('Admin.vehicle-note-edit', VehicleNotesDataservice::provideEditor($vehicleNote));
    }

    public function store(VehicleNoteRequest $request, Vehicle $vehicle): \Illuminate\Http\RedirectResponse
    {
        VehicleNotesDataservice::storeNew($request);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'notes']);
    }

    public function edit(Request $request, VehicleNote $vehicleNote)
    {
        if (!empty($request->old())) $vehicleNote->fill($request->old());
        return view('Admin.vehicle-note-edit', VehicleNotesDataservice::provideEditor($vehicleNote));
    }

    public function update(VehicleNoteRequest $request, VehicleNote $vehicleNote): \Illuminate\Http\RedirectResponse
    {
        VehicleNotesDataservice::update($request, $vehicleNote);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicleNote->vehicle, 'page' => 'notes']);
    }

    public function erase(VehicleNote $vehicleNote): \Illuminate\Http\RedirectResponse
    {
        $vehicleId = $vehicleNote->vehicle->id;
        VehicleNotesDataservice::erase($vehicleNote);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicleId, 'page' => 'notes']);
    }


}
