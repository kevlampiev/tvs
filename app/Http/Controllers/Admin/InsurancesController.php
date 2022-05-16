<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\InsurancesDataservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class InsurancesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routeIs('Admin.actualInsurancesByInsCompanies')) {
            return view('Admin.ActualInsurancesByInsCompanies',
                InsurancesDataservice::provideData(1));
        } else {
            return view('Admin.ActualInsurancesByInsTypes',
                InsurancesDataservice::provideData(2));
        }
    }

    public function actualInsurances(Request $request)
    {
        return view('Admin.InsuredVehicles', InsurancesDataservice::getActualInsurances());
    }
}
