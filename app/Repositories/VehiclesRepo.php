<?php


namespace App\Repositories;


use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VehiclesRepo
{
    static public function getVehicles(Request $request)
    {
        $filter = ($request->get('searchStr'))?$request->get('searchStr'): '';
        if ($filter==='') {
            $vehicles = Vehicle::query()->orderBy('name')->paginate(15);
        } else {
            $searchStr = '%'.str_replace(' ', '%', $filter).'%';
            $vehicles = Vehicle::query()
                ->where('name','like', $searchStr)
                ->orWhere('VIN','like', $searchStr)
                ->orWhere('bort_number','like', $searchStr)
                ->orWhere('model','like', $searchStr)
                ->orWhere('trademark','like', $searchStr)
                ->orWhereHas('Type',function (Builder $query) use($searchStr) {
                    $query->where('name','like',$searchStr);
                })
                ->orWhereHas('Manufacturer',function (Builder $query) use($searchStr) {
                    $query->where('name','like',$searchStr);
                })
                ->paginate(15);
                }
        return ['vehicles'=> $vehicles,
                'filter'=> $filter];
    }
}
