<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ReportsRepo;
use Illuminate\Http\Request;

class SettlementReportsController extends Controller
{
    public function showBigSettlementReport(Request $request)
    {
        return view('User.SettelementStateReport',
        ReportsRepo::getSettlementStatusData($request));
    }
}
