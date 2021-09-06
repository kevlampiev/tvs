<?php


namespace App\DataServices;


use Illuminate\Support\Facades\DB;

class NearestPaymentsDataservice
{
    public static function provideAllAgrData(): array
    {
        $upcomingPeriod = config('constants.upcomingPeriods.payments');
        $data = collect(DB::select('CALL agreement_settlements_by_today(?)', [$upcomingPeriod]))
            ->groupBy('company');
        return [
            'data' => $data,
            'upcomingPeriod' => $upcomingPeriod,
        ];

    }


}
