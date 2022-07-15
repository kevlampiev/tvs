<?php

namespace App\Http\Controllers;

use App\DataServices\Admin\VehicleLocationsDataservice;
use App\Http\Requests\VehicleLocationRequest;
use App\Models\VehicleLocation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehicleLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.vehicle-locations.vehicle-locations',
            ['vehicleLocations' => VehicleLocation::query()->orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $location = VehicleLocationsDataservice::create($request);
       return view('Admin.vehicle-locations.vehicle-location-edit', VehicleLocationsDataservice::provideData($location));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VehicleLocationRequest $request): RedirectResponse
    {
        VehicleLocationsDataservice::store($request);
        return redirect()->to(route('admin.locations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleLocation  $vehicleLocation
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleLocation $vehicleLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleLocation  $vehicleLocation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, VehicleLocation $location)
    {

        VehicleLocationsDataservice::edit($request, $location);
        return view('Admin.vehicle-locations.vehicle-location-edit',
            VehicleLocationsDataservice::provideData($location));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleLocation  $vehicleLocation
     * @return RedirectResponse
     */
    public function update(VehicleLocationRequest $request, VehicleLocation $location)
    {
        VehicleLocationsDataservice::update($request, $location);
        return redirect()->to(route('admin.locations'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleLocation  $vehicleLocation
     * @return RedirectResponse
     */
    public function destroy(VehicleLocation $location)
    {
        VehicleLocationsDataservice::delete($location);
        return redirect()->back();
    }
}
