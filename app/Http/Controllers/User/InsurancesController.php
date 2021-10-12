<?php

namespace App\Http\Controllers\User;

use App\DataServices\User\InsurancesDataservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class InsurancesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routeIs('user.actualInsurancesByInsCompanies')) {
            return view('User.ActualInsurancesByInsCompanies',
                InsurancesDataservice::provideData(1));
        } else {
            return view('User.ActualInsurancesByInsTypes',
                InsurancesDataservice::provideData(2));
        }
    }

    public function actualInsurances(Request $request)
    {
        return view('User.InsuredVehicles', InsurancesDataservice::getActualInsurances());
    }
}
