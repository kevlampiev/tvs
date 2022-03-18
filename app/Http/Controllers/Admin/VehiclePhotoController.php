<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehiclePhotoDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiclePhotoAddRequest;
use App\Http\Requests\VehiclePhotoEditRequest;
use App\Models\Vehicle;
use App\Models\VehiclePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehiclePhotoController extends Controller
{
    public function show(Request $request, VehiclePhoto $vehiclePhoto)
    {
        return response()
            ->file(storage_path('app/public/img/vehicles/') . $vehiclePhoto->img_file);
    }

    public function create(Request $request, Vehicle $vehicle)
    {
        $vehiclePhoto = new VehiclePhoto();
        $vehiclePhoto->vehicle_id = $vehicle->id;
        if (!empty($request->old())) $vehiclePhoto->fill($request->old());
        return view('Admin.vehicles.vehicle-photo-edit', VehiclePhotoDataservice::provideEditor($vehiclePhoto));
    }

    public function store(VehiclePhotoAddRequest $request, Vehicle $vehicle): RedirectResponse
    {
        VehiclePhotoDataservice::storeNew($request);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'photos']);
    }

    public function edit(VehiclePhotoEditRequest $request, VehiclePhoto $vehiclePhoto)
    {
        if (!empty($request->old())) $vehiclePhoto->fill($request->old());
        return view('Admin.vehicles.vehicle-photo-edit', VehiclePhotoDataservice::provideEditor($vehiclePhoto));
    }

    public function update(VehiclePhotoEditRequest $request, VehiclePhoto $vehiclePhoto): \Illuminate\Http\RedirectResponse
    {
        VehiclePhotoDataservice::update($request, $vehiclePhoto);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehiclePhoto->vehicle, 'page' => 'photos']);
    }

    public function erase(VehiclePhoto $vehiclePhoto): RedirectResponse
    {
        $vehicleId = $vehiclePhoto->vehicle->id;
        VehiclePhotoDataservice::erase($vehiclePhoto);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicleId, 'page' => 'photos']);
    }


}
