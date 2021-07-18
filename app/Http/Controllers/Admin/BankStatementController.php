<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Vehicle;
use App\DataServices\InsurancesRepo;
use Carbon\Carbon;
use Carbon\Factory;
use Illuminate\Http\Request;

class BankStatementController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.load-bank-statement');
    }


}
