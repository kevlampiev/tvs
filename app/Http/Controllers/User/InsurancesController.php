<?php

namespace App\Http\Controllers\User;

use App\DataServices\User\InsurancesDataservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class InsurancesController extends Controller
{
    public function index($reportType)
    {
        if ($reportType==="byCompanies") {
            return view('User.ActualInsurancesByInsCompanies',
                InsurancesDataservice::provideData(1));
        } else {
            return view('User.ActualInsurancesByInsTypes',
                InsurancesDataservice::provideData(2));
        }
    }


}
