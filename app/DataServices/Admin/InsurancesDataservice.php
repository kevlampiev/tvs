<?php


namespace App\DataServices\Admin;


use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\AgreementType;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Insurance;
use App\Models\InsuranceCompany;
use App\Models\InsuranceType;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsurancesDataservice
{
//    static public function getInsurances(Request $request)
//    {
//        $filter = ($request->get('searchStr')) ? $request->get('searchStr') : '';
//        if ($filter === '') {
//            $insurances = Insurance::query()
////                ->with('type')
//                ->orderByDesc('date_open')
//                ->paginate(15);
//        } else {
//            $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
//            $insurances = Insurance::query()
////                ->with('type')
//                ->orWhereHas('insuranceCompany', function (Builder $query) use ($searchStr) {
//                    $query->where('name', 'like', $searchStr);
//                })
//                ->orWhereHas('type', function (Builder $query) use ($searchStr) {
//                    $query->where('name', 'like', $searchStr);
//                })
//                ->orWhereHas('vehicle', function (Builder $query) use ($searchStr) {
//                    $query->where('name', 'like', $searchStr);
//                })
//                ->orderByDesc('date_open')
//                ->paginate(15);
//        }
//        return ['insurances' => $insurances,
//            'filter' => $filter];
//    }

    public static function provideInsuranceEditor(Insurance $insurance, $routeName): array
    {
        return [
            'insurance' => $insurance,
            'route' => $routeName,
            'vehicles' => Vehicle::query()->orderBy('name')->get(),
            'insuranceCompanies' => InsuranceCompany::query()->orderBy('name')->get(),
            'insTypes' => InsuranceType::query()->orderBy('name')->get(),
        ];
    }


    public static function defaultData(Vehicle $vehicle=null):array
    {
        return [
            'vehicle_id' => $vehicle?$vehicle->id:null,
            'date_open' => Carbon::today()->toDateString(),
            'date_close' => Carbon::today()->addYear()->toDateString(),
            'description' => 'Страхуемые риски: ущерб, хищение',
            'created_at' => Carbon::today()->toDateString(),
        ];
    }

    public static function create(Request $request, Vehicle $vehicle = null):Insurance
    {
        $insurance = new Insurance();
        if (!empty($request->old())) $insurance->fill($request->old());
        else $insurance->fill(self::defaultData($vehicle));
        return $insurance;
    }

    public static function store(Request $request)
    {
        $insurance = new Insurance();
        $insurance->fill($request->except(['id']));
        $insurance->save();
    }


}
