<?php


namespace App\Repositories;


use App\Models\Agreement;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReportsRepo
{

    static public function getBigSettlementReportData(Request $request)
    {
        $queryDate = ($request->get('reportDate'))?$request->get('reportDate'):date('Y-m-d');
        $data = Agreement::query()->with('payments')->
        whereHas('payments', function (Builder $query) use($queryDate){
            $query->where('canceled_date','>', $queryDate)
                ->orWhere('canceled_date',null)
                ->where('date_open','<=',$queryDate);
        })->get();
        foreach ($data as $el) {
            $el->total_payments = $el->payments->sum('amount');
            $el->payed = $el->realPayments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->must_be_payed_by_date = $el->payments->where('payment_date', '<=', $queryDate)->sum('amount');
            $el->company_name=$el->company->name;
            $el->counterparty_name = $el->counterparty->name;
        }
        return ['reportDate'=>$queryDate,
            'data'=>$data->groupBy('company_name')->sortBy('counterparty_name')];
    }

    static public function getAgreemantSettlementReportData(Request $request)
    {
        return [];
    }

}
