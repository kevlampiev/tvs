<?php

namespace App\Http\Controllers\User;

use App\DataServices\DashboardDataservice;
use App\DataServices\SettlementsRepo;
use App\DataServices\SettlementsReportsRepo;
use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Http\Request;

class SettlementReportsController extends Controller
{
    public function showBigSettlementReport(Request $request)
    {
        return view('User.SettlementStateReport',
            SettlementsReportsRepo::getBigReportData($request, 'company_name', 'counterparty_name'));
    }

    public function showBigSettlement2Report(Request $request)
    {
        return view('User.SettlementState2Report',
            SettlementsReportsRepo::getBigReportData($request, 'counterparty_name', 'company_name'));;
    }

    public function showAgrSettlementReport(Request $request, int $id)
    {
        return view('User.settlements-agreement-state',
            SettlementsReportsRepo::getAgreemantSettlementReportData($request, Agreement::find($id)));
    }
}
