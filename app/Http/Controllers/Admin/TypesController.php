<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTypeRequest;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.types', ['types'=>VehicleType::all()]);
     }

    public function addType(Request $request)
    {
        $type = new VehicleType();
        if ($request->isMethod('post')) {
            $type->fill($request->only('name'));
            $type->save();
            return redirect()->route('admin.vehicleTypes');
        } else {
            return view('Admin/type-edit', [
                'type' => $type,
                'route' => 'admin.addType',
            ]);
        }
    }

    public function editType(VehicleTypeRequest $request, VehicleType $type)
    {
        if ($request->isMethod('post')) {
            $type->fill($request->only('name'));
            $type->save();
            return redirect()->route('admin.vehicleTypes');
        } else {
            return view('Admin/type-edit', [
                'type' => $type,
                'route' => 'admin.editType',
            ]);
        }
    }

    public function deleteType(VehicleType $type)
    {
        $type->delete();
        return redirect()->route('admin.vehicleTypes');
    }
}
