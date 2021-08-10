<?php


namespace App\DataServices\Admin;


use App\Models\Insurance;
use App\Models\InsuranceCompany;
use App\Models\InsuranceType;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InsurancesDataservice
{

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

    public static function defaultValues(Vehicle $vehicle=null):array
    {
            return [
                'vehicle_id'=>($vehicle)?$vehicle->id:null,
                'date_open' => Carbon::today()->toDateString(),
                'date_close' => Carbon::today()->addYear()->toDateString(),
                'description'=> 'Страхуемые риски: ущерб, хищение',
            ];
    }

    public static function create(Request $request, Vehicle $vehicle = null):Insurance
    {
        $insurance = new Insurance();
        if (!empty($request->old())) $insurance->fill($request->old());
        else $insurance->fill(self::defaultValues($vehicle));
        return $insurance;

    }

    public static function saveChanges(Insurance $insurance)
    {
        $insurance->save();
    }

}
