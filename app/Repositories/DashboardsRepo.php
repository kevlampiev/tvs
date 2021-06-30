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
        $agreements = Agreement::query()
            ->with('payments')
            ->with('realPayments')
            ->whereHas('payments', function (Builder $query) use ($today) {
                $query->where('canceled_date', '>', $today)
                    ->orWhere('canceled_date', null)
                    ->where('date_open', '<=', $today)
                    ->where('payment_date', '<', $today);
            })
            ->whereHas('realPayments', function (Builder $query) use ($today) {
                $query->where('payment_date', '<', $today);
            })
            ->get();

        $upcomingPayments = AgreementPayment::query()
            ->where('date_open', '<=', Carbon::today())
            ->where('canceled_date', '>', Carbon::today())
            ->orWhere('canceled_date', null)
            ->whereBetween('payment_date', [Carbon::today(), Carbon::today()->addDays(14)])
            ->orderBy('payment_date')
            ->orderByDesc('amount')
            ->get();

        $payments = [];

        foreach ($agreements as $agreement) {
            $overduePayments = $agreement->payments->sum('amount') -
                $agreement->realPayments->sum('amount');
            if ($overduePayments > 0) {
                $payments[] = (object)[
                    'payment_date' => 'просрочено',
                    'amount' => $overduePayments,
                    'company' => $agreement->company->name,
                    'counterparty' => $agreement->counterparty->name,
                ];
            }
        }

        foreach ($upcomingPayments as $payment) {
            $payments[] = (object)[
                'payment_date' => $payment->payment_date,
                'amount' => $payment->amount,
                'company' => $payment->agreement->company->name,
                'counterparty' => $payment->agreement->counterparty->name,
            ];
        }

        return [
            'payments' => collect($payments),
        ];

    }

}
