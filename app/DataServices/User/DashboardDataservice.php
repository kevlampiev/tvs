<?php


namespace App\DataServices\User;


use App\Models\VehicleNote;
use Illuminate\Support\Facades\DB;

class DashboardDataservice
{
    public static function provideData(): array
    {
        $paymentInfo = self::getUpcomingPayments();

        return [
            'data' => json_encode(self::getChartData($paymentInfo), JSON_UNESCAPED_UNICODE),
            'summary' => self::getPaymentsSummary($paymentInfo),
            'runningOutOfIns' => self::getInsurancesData(),
            'uninsuredVehiclesCount' => self::getUninsuredVehiclesNumber(),
            'notes' => self::getLastNotes(),
            'upcomingInsurancesPeriod' => config('constants.upcomingPeriods.insurances'),
            'upcomingPaymentsPeriod' => config('constants.upcomingPeriods.payments'),
        ];

    }

    private static function getInsurancesData()
    {
        $upcomingPeriod = config('constants.upcomingPeriods.insurances');
        $data = DB::select('call insurance_to_made_by_today(?)', [$upcomingPeriod]);
        return $data;
    }


    private static function getUninsuredVehiclesNumber(): int
    {
        $row = DB::selectOne('select count(*) as univ from vehicles where id not in (select vehicle_id from insurances)');
        return (int)$row->univ;
    }

    private static function getUpcomingPayments()
    {
        $upcomingPeriod = config('constants.upcomingPeriods.payments');
        $data = DB::select('CALL settlements_by_date(?)', [$upcomingPeriod]);
        return collect($data);
    }

    private static function getChartData($paymentInfo): array
    {
        $data = [];
        $data[] = ['Компания', 'Просрочено, млн', 'Срочные платежи, млн'];
        foreach ($paymentInfo as $payment) {
            $data[] = [$payment->company, max($payment->overdue / 10 ** 6, 0), max($payment->upcoming / 10 ** 6, 0)];
        }
        return $data;
    }

    private static function getPaymentsSummary($paymentInfo)
    {
        return (object)[
            'overdue' => $paymentInfo->sum('overdue') / 10 ** 6,
            'upcoming' => $paymentInfo->sum('upcoming') / 10 ** 6,
        ];
    }

    private static function getLastNotes()
    {
        return VehicleNote::query()->with('vehicle')->orderByDesc('created_at')->limit(10)->get();
    }
}
