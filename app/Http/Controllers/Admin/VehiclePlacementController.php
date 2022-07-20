<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\VehiclePlacementDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiclePlacementRequest;
use App\Models\Vehicle;
use App\Models\VehiclePlacement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehiclePlacementController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request, Vehicle $vehicle)
    {
        $placement = VehiclePlacementDataservice::create($request, $vehicle);
        return view('Admin.vehicles.vehicle-add-placement', VehiclePlacementDataservice::provideData($placement));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VehiclePlacementRequest $request, Vehicle $vehicle): RedirectResponse
    {
        VehiclePlacementDataservice::store($request);
        return redirect()->to(route('admin.vehicleSummary',['vehicle'=>$vehicle,
            'page' => 'placements']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleLocation  $vehicleLocation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, VehiclePlacement $placement)
    {

        VehiclePlacementDataservice::edit($request, $placement);
        return view('Admin.vehicles.vehicle-add-placement',
            VehiclePlacementDataservice::provideData($placement));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleLocation  $vehicleLocation
     * @return RedirectResponse
     */
    public function update(VehiclePlacementRequest $request, VehiclePlacement $placement)
    {
        VehiclePlacementDataservice::update($request, $placement);
        return redirect()->to(route('admin.vehicleSummary',['vehicle' => $placement->vehicle,
            'page' => 'placements']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleLocation  $vehicleLocation
     * @return RedirectResponse
     */
    public function destroy(VehiclePlacement $placement)
    {
        VehiclePlacementDataservice::delete($placement);
        return redirect()->back();
    }
}
