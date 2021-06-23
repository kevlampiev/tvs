<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Repositories\ReportsRepo;
use Illuminate\Http\Request;

class SettlementReportsController extends Controller
{
    public function showBigSettlementReport(Request $request)
    {
        return view('User.SettelementStateReport',
            ReportsRepo::getBigSettlementReportData($request));
    }

    public function showBigSettlement2Report(Request $request)
    {
        return view('User.SettelementState2Report',
            ReportsRepo::getBigSettlementReport2Data($request));
    }

    public function showAgrSettlementReport(Request $request, Agreement $agreement)
    {
        return view('User.SettelementAgreementReport',
            ReportsRepo::getAgreemantSettlementReportData($request, $agreement));
    }
}
