<?php


namespace App\Repositories;


use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclesRepo
{
    static public function getVehicles(Request $request)
    {
        $filter = ($request->get('searchStr'))?$request->get('searchStr'): '';
        if ($filter==='') {
            $vehicles = Vehicle::query()->orderBy('name')->get();
        } else {
            $searchStr = '%'.str_replace(' ', '%', $filter).'%';
            $vehicles = Vehicle::query()
                ->where('name','like', $searchStr)
                ->orWhere('VIN','like', $searchStr)
                ->orWhere('bort_number','like', $searchStr)
                ->orWhere('model','like', $searchStr)
                ->orWhere('trademark','like', $searchStr)
                ->get();
                }
        return ['vehicles'=> $vehicles,
                'filter'=> $filter];
    }
}
