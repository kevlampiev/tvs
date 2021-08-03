<?php

namespace App\Http\Controllers\User;

use App\DataServices\User\InsurancesToRenewalDataservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsurancesToRenewalController extends Controller
{
    public function index()
    {
        return view('User.insurances_to_be_made',
        InsurancesToRenewalDataservice::provideData());
    }
}
