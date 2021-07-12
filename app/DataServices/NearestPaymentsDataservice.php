<?php


namespace App\DataServices;


use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\RealPayment;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Object_;

class NearestPaymentsDataservice
{
    public static function provideAllAgrData(): array
    {
        $upcomingPeriod =config('constants.upcomingPeriods.payments');
        $data=collect(DB::select('CALL get_agreement_settlements_by_today(?)',[$upcomingPeriod]))
            ->groupBy('company');
        return [
            'data' => $data,
            'upcomingPeriod' => $upcomingPeriod,
        ];

    }


}
