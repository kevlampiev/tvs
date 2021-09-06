<?php

namespace App\Http\Controllers\User;

use App\DataServices\NearestPaymentsDataservice;
use App\Http\Controllers\Controller;

class NearestPaymentsController extends Controller
{
    public function showAllAgr()
    {
        return view('User.nearest-payments', NearestPaymentsDataservice::provideAllAgrData());
    }
}
