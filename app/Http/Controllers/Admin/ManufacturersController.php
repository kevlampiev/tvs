<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\ManufacturersDataservice;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function index()
    {
        return view('Admin.manufacturers', ManufacturersDataservice::provideData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $manufacturer = new Manufacturer();
        if (!empty($request->old())) {
            $manufacturer->fill($request->old());
        }
        return view('Admin.manufacturer-edit', [
            'manufacturer' => $manufacturer,
            'route' => 'admin.addManufacturer',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ManufacturerRequest $request
     * @return RedirectResponse
     */
    public function store(ManufacturerRequest $request): RedirectResponse
    {
        $manufacturer = new Manufacturer();
        $manufacturer->fill($request->all())->save();
        session()->flash('message', 'Добавлен новый производитель');
        return redirect()->route('admin.manufacturers');
    }

    /**
     * Display the specified resource.
     *
     * @param Manufacturer $manufacturer
     * @return void
     */
    public function show(Manufacturer $manufacturer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return View
     */
    public function edit(Request $request, Manufacturer $manufacturer): View
    {
        if (!empty($request->old())) {
            $manufacturer->fill($request->old());
        }
        return view('Admin.manufacturer-edit', [
            'manufacturer' => $manufacturer,
            'route' => 'admin.editManufacturer',
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param ManufacturerRequest $request
     * @param Manufacturer $manufacturer
     * @return RedirectResponse
     */
    public function update(ManufacturerRequest $request, Manufacturer $manufacturer): RedirectResponse
    {

        $manufacturer->fill($request->all())->save();
        session()->flash('message', 'Информация о производителе изменена');
        return redirect()->route('admin.manufacturers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Manufacturer $manufacturer
     * @return RedirectResponse
     */
    public function destroy(Manufacturer $manufacturer): RedirectResponse
    {
        $manufacturer->delete();
        session()->flash('message', 'Информация о производителе удалена');
        return redirect()->route('admin.manufacturers');
    }


}
