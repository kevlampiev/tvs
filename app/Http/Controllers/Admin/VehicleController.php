<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Repositories\VehiclesRepo;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.vehicles', VehiclesRepo::getVehicles($request));
    }

    public function addVehicle(Request $request)
    {
        $vehicle = new Vehicle();
        if ($request->isMethod('post')) {
            $this->validate($request, Vehicle::rules());
            $vehicle->fill($request->except(['id', 'created_at', 'updated_at']));
            $vehicle->save();
            return redirect()->route('admin.vehicles');
        } else {
            if (!empty($request->old())) {
                $vehicle->fill($request->old());
            }
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
            $this->validate($request, Vehicle::rules());
            $vehicle->fill($request->except(['id', 'created_at', 'updated_at']));
            $vehicle->save();
            $route= session('previous_url', route('admin.vehicles'));
            return redirect()->to($route);
        } else {
            if (!empty($request->old())) {
                $vehicle->fill($request->old());
            }
            if (url()->previous()!==url()->current()) session(['previous_url'=>url()->previous()]);
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
