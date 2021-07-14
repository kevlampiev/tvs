<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataServices\NearestPaymentsDataservice;
use Illuminate\Http\Request;

class NearestPaymentsController extends Controller
{
    public function showAllAgr()
    {
        return view('User.nearest-payments', NearestPaymentsDataservice::provideAllAgrData());
    }
}
