<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehicleNotesDataservice;
use App\DataServices\Admin\VehiclePhotoDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleNoteRequest;
use App\Http\Requests\VehiclePhotoAddRequest;
use App\Models\Vehicle;
use App\Models\VehicleNote;
use App\Models\VehiclePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehiclePhotoController extends Controller
{
    public function create(Request $request, Vehicle $vehicle)
    {
        $vehiclePhoto = new VehiclePhoto();
        $vehiclePhoto->vehicle_id = $vehicle
        if (!empty($request->old())) $vehiclePhoto->fill($request->old());
        return view('Admin.vehicle-photo-edit', VehiclePhotoDataservice::provideEditor($vehiclePhoto));
    }

    public function store(VehiclePhotoAddRequest $request, Vehicle $vehicle): RedirectResponse
    {
        VehiclePhotoDataservice::storeNew($request);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'photos']);
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
