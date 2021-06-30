<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Agreement;
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
                'vehicleTypes' => VehicleType::query()->orderBy('name')->get(),
                'manufacturers' => Manufacturer::query()->orderBy('name')->get(),
            ]);
        }
    }

    public function editVehicle(VehicleRequest $request, Vehicle $vehicle)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, Vehicle::rules());
            $vehicle->fill($request->except(['id', 'created_at', 'updated_at']));
            $vehicle->save();
            $route = session('previous_url', route('admin.vehicles'));
            return redirect()->to($route);
        } else {
            if (!empty($request->old())) {
                $vehicle->fill($request->old());
            }
            if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
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

    public function attachAgreement(Request $request, Vehicle $vehicle)
    {
        if ($request->isMethod('post')) {
            $agreement = Vehicle::find($request->agreement_id);
            $vehicle->agreements()->save($agreement);
            return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'agreements']);
        } else {
            return view('Admin/vehicle-add-agreement',
                VehiclesRepo::provideAddAgreementView($vehicle));
        }
    }

    public function detachAgreement(Request $request, Vehicle $vehicle, Agreement $agreement)
    {
        dd($request);
        $vehicle->agreements()->detach($agreement);
        return redirect()->route('admin.vehicleSummary', ['vehicle' => $vehicle, 'page' => 'agreements']);
    }

}
