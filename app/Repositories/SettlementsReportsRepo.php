<?php


namespace App\Repositories;


use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\RealPayment;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SettlementsReportsRepo
{
    /**
     *Обеспечивает данные Большому отчету по состоянию расчетов тип 1 (группировка по компаниям)
     */
    static public function getBigSettlementReportData(Request $request)
    {
        $queryDate = ($request->get('reportDate')) ? $request->get('reportDate') : date('Y-m-d');
        $data = Agreement::query()->with('payments')->
        whereHas('payments', function (Builder $query) use ($queryDate) {
            $query->where('canceled_date', '>', $queryDate)
                ->orWhere('canceled_date', null)
                ->where('date_open', '<=', $queryDate);
        })->get();
        foreach ($data as $el) {
            $el->total_payments = $el->payments->sum('amount');
            $el->payed = $el->realPayments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->must_be_payed_by_date = $el->payments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->company_name = $el->company->name;
            $el->counterparty_name = $el->counterparty->name;
        }
        return ['reportDate' => $queryDate,
            'data' => $data->groupBy('company_name')->sortBy('counterparty_name')];
    }

    /**
     *Обеспечивает данные Большому отчету по состоянию расчетов тип 2 (группировка по контрагентам)
     */
    static public function getBigSettlementReport2Data(Request $request)
    {
        $queryDate = ($request->get('reportDate')) ? $request->get('reportDate') : date('Y-m-d');
        $data = Agreement::query()->with('payments')->
        whereHas('payments', function (Builder $query) use ($queryDate) {
            $query->where('canceled_date', '>', $queryDate)
                ->orWhere('canceled_date', null)
                ->where('date_open', '<=', $queryDate);
        })->get();
        foreach ($data as $el) {
            $el->total_payments = $el->payments->sum('amount');
            $el->payed = $el->realPayments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->must_be_payed_by_date = $el->payments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->company_name = $el->company->name;
            $el->counterparty_name = $el->counterparty->name;
        }
        return ['reportDate' => $queryDate,
            'data' => $data->groupBy('counterparty_name')->sortBy('company_name')];
    }

    /**
     *Обеспечивает данные отчету по состоянию расчетов по договору
     */
    static public function getAgreemantSettlementReportData(Request $request, Agreement $agreement)
    {
        $queryDate = ($request->get('reportDate')) ? $request->get('reportDate') : date('Y-m-d');
        $payedByNow = RealPayment::query()
            ->where('agreement_id', '=', $agreement->id)
            ->where('payment_date', '<=', $queryDate)
            ->sum('amount');
        $agrPayments = AgreementPayment::query()
            ->where('canceled_date', '>', $queryDate)
            ->orWhere('canceled_date', null)
            ->where('date_open', '<=', $queryDate)
            ->where('agreement_id', '=', $agreement->id)
            ->orderBy('payment_date')
            ->get()
            ->transform(function ($item) use (&$payedByNow, $queryDate) {
                if ($item->payment_date > $queryDate) {
                    $item->status = 'срочный';
                } else {
                    $payedByNow -= $item->amount;
                    $item->status = ($payedByNow > 0) ? 'погашен' : 'просрочен';
                }
                return $item;
            });

        return [
            'reportDate' => $queryDate,
            'agreement' => $agreement,
            'payments' => $agrPayments];
    }

}
