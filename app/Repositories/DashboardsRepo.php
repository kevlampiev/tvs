<?php


namespace App\Repositories;


use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\RealPayment;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardsRepo
{
    public static function provideData(): array
    {
        $today = Carbon::today();
        $horizontDate = Carbon::today()->addDays(14);
        $agreements = Agreement::all();
        foreach($agreements as $agreement) {
            $agreement->company = $agreement->company->name;
            $agreement->overdue =
                max($agreement->payments->where('payment_date','<',$today)->sum('amount')-
                    $agreement->realPayments->where('payment_date','<',$today)->sum('amount'),
                    0);
            $agreement->nearestPayments = $agreement->payments
                ->where('payment_date','>=',$today)
                ->where('payment_date','<=', $horizontDate)
                ->sum('amount');
        }
        return [
            'data' => $agreements->groupBy('company'),
        ];

    }

}
