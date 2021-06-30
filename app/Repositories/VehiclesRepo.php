<?php


namespace App\Repositories;


use App\Models\Agreement;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiclesRepo
{
    static public function getVehicles(Request $request)
    {
        $filter = ($request->get('searchStr')) ? $request->get('searchStr') : '';
        if ($filter === '') {
            $vehicles = Vehicle::query()->orderBy('name')->paginate(15);
        } else {
            $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
            $vehicles = Vehicle::query()
                ->where('name', 'like', $searchStr)
                ->orWhere('VIN', 'like', $searchStr)
                ->orWhere('bort_number', 'like', $searchStr)
                ->orWhere('model', 'like', $searchStr)
                ->orWhere('trademark', 'like', $searchStr)
                ->orWhereHas('VehicleType', function (Builder $query) use ($searchStr) {
                    $query->where('name', 'like', $searchStr);
                })
                ->orWhereHas('Manufacturer', function (Builder $query) use ($searchStr) {
                    $query->where('name', 'like', $searchStr);
                })
                ->paginate(15);
        }
        return ['vehicles' => $vehicles,
            'filter' => $filter];
    }

    static public function getSummary():array
    {
        $vehicle = Vehicle::query()->find(1);
        return ['vehicle'=>$vehicle];
    }


    //TODO переделать метод через Eloquent для архитектурной чистоты

    /**
     * Метод наполнения данными view добавления к единице техники договоров
     * @param Vehicle $vehicle
     * @return array
     */
    public static function provideAddAgreementView(Vehicle $vehicle): array
    {

        $presentedAgreements =
            DB::select('select agreement_id from agreement_vehicle where vehicle_id=?', [$vehicle->id]);

        $data = [];
        foreach ($presentedAgreements as $el) {
            $data[] = $el->agreement_id;
        }
        $agreements = Agreement::query()->whereNotIn('id', $data)->orderBy('name')->get();
        return [
            'vehicle' => $vehicle,
            'agreements' => $agreements
        ];
    }
}
