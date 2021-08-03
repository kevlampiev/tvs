<?php


namespace App\DataServices\User;


use Illuminate\Support\Facades\DB;

class InsurancesToRenewalDataservice
{
    public static function provideData():array
    {
        $upcomingPeriod = config('constants.upcomingPeriods.insurances');
        $data = DB::select('call pg_insurances_to_renewal(?)', [$upcomingPeriod]);
        return ['data' => $data, 'upcomingPeriod' => $upcomingPeriod];
    }

}
