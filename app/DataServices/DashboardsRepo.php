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
            SELECT c.code as company,
                    COALESCE(SUM(ap.amount),0)-COALESCE(SUM(rp.amount),0)  as overdue,
                    COALESCE(sum(fp.amount),0) as upcoming
            FROM companies c
            INNER JOIN agreements a ON c.id=a.company_id
            LEFT JOIN agreement_payments ap ON a.id=ap.agreement_id AND ap.payment_date<current_date()
            LEFT JOIN real_payments rp ON a.id=rp.agreement_id AND rp.payment_date<current_date()
            LEFT JOIN agreement_payments fp ON a.id=fp.agreement_id AND (fp.payment_date BETWEEN current_date() AND  DATE_ADD(CURRENT_DATE(), INTERVAL 14 DAY))
            GROUP BY c.code
        ');

        return collect($data);
    }

    private static function getChartData( $paymentInfo):array
    {
        $data = [];
        $data[] = ['Компания', 'Просрочено, млн', 'Срочные платежи, млн'];
        foreach ($paymentInfo as $payment) {
            $data[] = [$payment->company, $payment->overdue/ 10**6, $payment->upcoming/ 10**6];
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
