<?php


namespace App\Repositories;


use App\Models\Agreement;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AgreementsRepo
{
    static public function getAgreements(Request $request)
    {
        $filter = ($request->get('searchStr'))?$request->get('searchStr'): '';
        if ($filter==='') {
            $agreements = Agreement::query()
                ->orderBy('Company_id')
                ->orderBy('Counterparty_id')
                ->paginate(15);
        } else {
            $searchStr = '%'.str_replace(' ', '%', $filter).'%';
            $agreements = Agreement::query()
                ->where('name','like', $searchStr)
//                ->orWhere('Company','like', $searchStr)
//                ->orWhere('Counterparty','like', $searchStr)
                ->orderBy('Company_id')
                ->orderBy('Counterparty_id')
                ->orderBy('date_open')
                ->paginate(15);
                }
        return ['agreements'=> $agreements,
                'filter'=> $filter];
    }
}
