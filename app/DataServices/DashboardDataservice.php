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
use phpDocumentor\Reflection\Types\Collection;
use phpDocumentor\Reflection\Types\Object_;

class DashboardDataservice
{
    public static function provideData(): array
    {
        $paymentInfo = self::getUpcomingPayments();
        return [
            'data' => json_encode(self::getChartData($paymentInfo), JSON_UNESCAPED_UNICODE),
            'summary' => self::getPaymentsSummary($paymentInfo),
            'runningOutOfIns' => self::getInsurancesData()
        ];

    }

    private static function getInsurancesData()
    {
        $data = DB::select('call insurance_to_made_by_today(?)',[14]);
        return $data;
    }


    private static function getUpcomingPayments()
    {
        $data = DB::select('CALL settlements_by_date(?)',[14]);
        return collect($data);
    }

    private static function getChartData( $paymentInfo):array
    {
        $data = [];
        $data[] = ['Компания', 'Просрочено, млн', 'Срочные платежи, млн'];
        foreach ($paymentInfo as $payment) {
            $data[] = [$payment->company, max($payment->overdue/ 10**6,0), max($payment->upcoming/ 10**6, 0)];
        }
        return $data;
    }

    private static function getPaymentsSummary($paymentInfo)
    {
        return (object) [
            'overdue' => $paymentInfo->sum('overdue') / 10**6,
            'upcoming' => $paymentInfo->sum('upcoming') / 10**6
        ];
    }
}
