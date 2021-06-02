<?php

namespace App\Http\Controllers\Admin;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class DictionariesController extends Controller
{
    public function allVehicleTypes(Request $request): string
    {
        return view('Admin.types', ['types' => VehicleType::all()]);
    }
}
