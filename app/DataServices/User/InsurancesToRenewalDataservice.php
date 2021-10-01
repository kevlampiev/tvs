<?php


namespace App\DataServices\User;


use Illuminate\Support\Facades\DB;

class InsurancesToRenewalDataservice
{
    public static function provideData(): array
    {
        $upcomingPeriod = config('constants.upcomingPeriods.insurances');
        $data = collect(DB::select('call ps_insurances_to_renewal(?)', [$upcomingPeriod]));
        return ['insurancesToRenewal' => $data->where('insurance_company','!=',null)->all(),
                'uninsuredVehicles' => $data->where('insurance_company','=',null)->all(),
            'upcomingPeriod' => $upcomingPeriod];
    }

}
