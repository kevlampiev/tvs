<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehicleDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Agreement;
use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleNote;
use App\Models\VehicleType;
use App\DataServices\VehiclesRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.vehicles', VehiclesRepo::getVehicles($request));
    }

    public function create(Request $request)
    {
        $vehicle = new Vehicle();
        if (!empty($request->old())) $vehicle->fill($request->old());
        return view('Admin/vehicle-edit', VehicleDataservice::provideEditorForm($vehicle));
    }

    public function store(VehicleRequest $request)
    {
        VehicleDataservice::storeNewVehicle($request);
        return redirect()->route('admin.vehicles');
    }

    public function edit(Request $request, Vehicle $vehicle)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        if (!empty($request->old())) $vehicle->fill($request->old());
        return view('Admin/vehicle-edit', VehicleDataservice::provideEditorForm($vehicle));
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        VehicleDataservice::updateVehicle($request, $vehicle);
        $route = session('previous_url', route('admin.vehicles'));
        return redirect()->to($route);
    }

    public function erase(Vehicle $vehicle)
    {
        VehicleDataservice::erase($vehicle);
        return redirect()->route('admin.vehicles');
    }

    public function vehicleSummary(Vehicle $vehicle)
    {
        return view('Admin/vehicle-summary',
            ['vehicle' => $vehicle,
                'notes' => VehicleNote::where('vehicle_id', '=', $vehicle->id)->with('user')->orderByDesc('created_at')->get(),
            ]);
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
