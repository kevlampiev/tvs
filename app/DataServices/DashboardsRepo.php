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

class DashboardsRepo
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
        $data = DB::select('
        SELECT v.name FROM vehicles v
            LEFT JOIN (
            SELECT vehicle_id, max(date_close) last_date FROM insurances GROUP BY vehicle_id HAVING last_date>DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY)
            ) alive_insurances ON v.id=alive_insurances.vehicle_id
            WHERE alive_insurances.vehicle_id IS NULL
        ');
        return $data;
    }


    private static function getUpcomingPayments()
    {
        $data = DB::select('
            SELECT code, sum(must_be_payed-payed) overdue, sum(upcoming) upcoming
                FROM (
                SELECT c.code, sum(p.amount) must_be_payed, 0 payed, 0 upcoming
                FROM companies c
                INNER JOIN agreements a ON a.company_id = c.id
                INNER JOIN agreement_payments p ON p.agreement_id=a.id and p.payment_date<current_date()
                GROUP BY c.code
            UNION
            SELECT c.code, 0 must_be_payed, sum(p.amount) payed, 0 upcoming
                FROM companies c
                INNER JOIN agreements a ON a.company_id = c.id
                INNER JOIN real_payments p ON p.agreement_id=a.id and p.payment_date<current_date()
                GROUP BY c.code
            UNION
            SELECT c.code, 0 must_be_payed, 0 payed, sum(p.amount) upcoming
                FROM companies c
                INNER JOIN agreements a ON a.company_id = c.id
                INNER JOIN agreement_payments p ON p.agreement_id=a.id and (p.payment_date BETWEEN current_date() AND DATE_ADD(current_date(), INTERVAL 14 DAY))
                GROUP BY c.code
                ) as gross_p
            GROUP BY code
            ');

        return collect($data);
    }

    private static function getChartData( $paymentInfo):array
    {
        $data = [];
        $data[] = ['Компания', 'Просрочено, млн', 'Срочные платежи, млн'];
        foreach ($paymentInfo as $payment) {
            $data[] = [$payment->code, $payment->overdue/ 10**6, $payment->upcoming/ 10**6];
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
