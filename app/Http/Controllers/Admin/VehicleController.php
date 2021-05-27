<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.vehicles', [
            'vehicles' => Vehicle::all()]);
    }

    public function addVehicle(Request $request)
    {
        $vehicle = new Vehicle();
        if ($request->isMethod('post')) {
            $vehicle->fill($request->except(['id', 'created_at', 'updated_at']));
            $vehicle->save();
            return redirect()->route('admin.vehicles');
        } else {
            return view('Admin/vehicle-edit', [
                'vehicle' => $vehicle,
                'route' => 'admin.addVehicle',
                'vehicleTypes' => VehicleType::all(),
                'manufacturers' => Manufacturer::all(),
            ]);
        }
    }

    public function editVehicle(VehicleRequest $request, Vehicle $vehicle)
    {
        if ($request->isMethod('post')) {
            $vehicle->fill($request->except(['id', 'created_at', 'updated_at']));
            $vehicle->save();
            return redirect()->route('admin.vehicles');
        } else {
            return view('Admin/vehicle-edit', [
                'vehicle' => $vehicle,
                'route' => 'admin.editVehicle',
                'vehicleTypes' => VehicleType::all(),
                'manufacturers' => Manufacturer::all(),
            ]);
        }
    }

    public function deleteVehicle(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles');
    }

    public function vehicleSummary(Vehicle $vehicle)
    {
        return view('Admin/vehicle-summary', ['vehicle' => $vehicle]);
    }
}
