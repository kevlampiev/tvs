<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Repositories\DashboardsRepo;
use App\Repositories\SettlementsRepo;
use Illuminate\Http\Request;

class SettlementReportsController extends Controller
{
    public function showBigSettlementReport(Request $request)
    {
        return view('User.SettlementStateReport',
            SettlementsRepo::getBigSettlementReportData($request));
    }

    public function showBigSettlement2Report(Request $request)
    {
        return view('User.SettlementState2Report',
            SettlementsRepo::getBigSettlementReport2Data($request));
    }

    public function showAgrSettlementReport(Request $request, Agreement $agreement)
    {
        return view('User.SettlementAgreementReport',
            SettlementsRepo::getAgreemantSettlementReportData($request, $agreement));
    }
}
