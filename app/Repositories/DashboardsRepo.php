<?php


namespace App\Repositories;


use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\RealPayment;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class DashboardsRepo
{
    public static function provideData(): array
    {
        $today = Carbon::today();
        $horizontDate = Carbon::today()->addDays(14);
        $agreements = Agreement::all();
        $data = [];

        foreach ($agreements as $el) {
            $el->company_code = $el->company->code;
            $el->overdues = max($el->payments->where('payment_date', '<', $today)->sum('amount') -
                $el->realPayments->where('payment_date', '<', $today)->sum('amount'), 0);
            $el->upcoming = $el->payments
                ->where('payment_date', '>=', $today)
                ->where('payment_date', '<=', $horizontDate)
                ->sum('amount');
        }

        $summary = (object)[
            'overdue' => $agreements->sum('overdues') / 1000000,
            'upcoming' => $agreements->sum('upcoming') / 1000000
        ];
        $data[] = ['Компания', 'Просрочено, млн', 'Срочные платежи, млн'];
        foreach ($agreements->groupBy('company_code') as $key => $agreement) {
            $data[] = [$key, $agreement->sum('overdues') / 1000000, $agreement->sum('upcoming') / 1000000];
        }

        return [
            'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
            'summary' => $summary
        ];

    }
}
