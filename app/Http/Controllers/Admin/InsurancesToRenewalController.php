<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\User\InsurancesToRenewalDataservice;
use App\Http\Controllers\Controller;

class InsurancesToRenewalController extends Controller
{
    public function index()
    {
        return view('Admin.insurances_to_be_made',
            InsurancesToRenewalDataservice::provideData());
    }
}
