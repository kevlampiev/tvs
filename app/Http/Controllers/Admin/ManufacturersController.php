<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTypeRequest;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.manufacturers', ['manufacturers'=>Manufacturer::all()]);
    }

    public function addManufacturer(Request $request)
    {
        $manufacturer = new Manufacturer();
        if ($request->isMethod('post')) {
            $manufacturer->fill($request->only('name'));
            $manufacturer->save();
            return redirect()->route('admin.manufacturers');
        } else {
            return view('Admin/manufacturer-edit', [
                'manufacturer' => $manufacturer,
                'route' => 'admin.addManufacturer',
            ]);
        }
    }

    public function editManufacturer(Request $request, Manufacturer $manufacturer)
    {
        if ($request->isMethod('post')) {
            $manufacturer->fill($request->only('name'));
            $manufacturer->save();
            return redirect()->route('admin.manufacturers');
        } else {
            return view('Admin/manufacturer-edit', [
                'manufacturer' => $manufacturer,
                'route' => 'admin.editManufacturer',
            ]);
        }
    }

    public function deleteManufacturer(Manufacturer $manufacturer): \Illuminate\Http\RedirectResponse
    {
        $manufacturer->delete();
        return redirect()->route('admin.manufacturers');
    }
}
