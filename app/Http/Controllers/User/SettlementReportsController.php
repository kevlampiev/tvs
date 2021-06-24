<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Repositories\DashboardsRepo;
use Illuminate\Http\Request;

class SettlementReportsController extends Controller
{
    public function showBigSettlementReport(Request $request)
    {
        return view('User.SettelementStateReport',
            DashboardsRepo::getBigSettlementReportData($request));
    }

    public function showBigSettlement2Report(Request $request)
    {
        return view('User.SettelementState2Report',
            DashboardsRepo::getBigSettlementReport2Data($request));
    }

    public function showAgrSettlementReport(Request $request, Agreement $agreement)
    {
        return view('User.SettelementAgreementReport',
            DashboardsRepo::getAgreemantSettlementReportData($request, $agreement));
    }
}
