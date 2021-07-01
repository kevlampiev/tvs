<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Repositories\DashboardsRepo;
use App\Repositories\SettlementsRepo;
use App\Repositories\SettlementsReportsRepo;
use Illuminate\Http\Request;

class SettlementReportsController extends Controller
{
    public function showBigSettlementReport(Request $request)
    {
        return view('User.SettlementStateReport',
            SettlementsReportsRepo::getBigSettlementReportData($request));
    }

    public function showBigSettlement2Report(Request $request)
    {
        return view('User.SettlementState2Report',
            SettlementsReportsRepo::getBigSettlementReport2Data($request));
    }

    public function showAgrSettlementReport(Request $request, Agreement $agreement)
    {
        return view('User.SettlementAgreementReport',
            SettlementsReportsRepo::getAgreemantSettlementReportData($request, $agreement));
    }
}
