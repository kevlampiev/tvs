<?php

namespace App\Http\Controllers\User;

use App\DataServices\User\InsurancesDataservice;
use App\Http\Controllers\Controller;

class InsurancesController extends Controller
{
    public function index()
    {
        return view('User.ActualInsurancesByInsCompanies',
            InsurancesDataservice::provideData(1));
    }
}
