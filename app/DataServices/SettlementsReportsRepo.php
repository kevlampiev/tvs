<?php


namespace App\DataServices;


use App\Models\Agreement;
use App\Models\AgreementPayment;
use App\Models\Company;
use App\Models\RealPayment;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class SettlementsReportsRepo
{

    /**
     * Возвращает набор состояния расчетов на заданную дату
     */
    public static function getPayments($queryDate): object
    {
        $data = Agreement::query()
            ->where('real_date_close', null)
            ->orWhere('real_date_close', '>=', $queryDate)
            ->get();
        foreach ($data as $el) {
            $el->total_payments = $el->payments->sum('amount');
            $el->payed = $el->realPayments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->must_be_payed_by_date = $el->payments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->company_name = $el->company->name;
            $el->counterparty_name = $el->counterparty->name;
        }
        return $data;
    }


    /**
     *Выдает укрупненные данные о состоянии просрочек расчетов на дату
     */
    public static function getAggPayments($queryDate): object
    {
        $agreements = Agreement::all();
        $result = [];
        foreach ($agreements as $agreement) {
            $agreement->company = $agreement->company->name;
            $agreement->overdue =
                max($agreement->payments->where('payment_date', '<=', $queryDate)->sum('amount') -
                    $agreement->realPayments->where('payment_date', '<=', $queryDate)->sum('amount'),
                    0);
        }
        return $agreements->groupBy('company');
    }


    /**
     *Обеспечивает данные Большому отчету по состоянию расчетов тип 1 (группировка по компаниям)
     */
    static public function getBigReportData(Request $request,
                                            $groupBy = 'company_name', $sortBy = 'counterparty_name')
    {
        $queryDate = ($request->get('reportDate')) ? $request->get('reportDate') : date('Y-m-d');
        $data = self::getPayments($queryDate);
        return ['reportDate' => $queryDate,
            'data' => $data->groupBy($groupBy)->sortBy($sortBy)];
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
                    $item->status = ($payedByNow >= 0) ? 'погашен' : 'просрочен';
                }
                return $item;
            });

        return [
            'reportDate' => $queryDate,
            'agreement' => $agreement,
            'payments' => $agrPayments];
    }

}
