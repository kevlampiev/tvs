<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\NearestPaymentsDataservice;
use App\Http\Controllers\Controller;

class NearestPaymentsController extends Controller
{
    public function showAllAgr()
    {
        return view('Admin.nearest-payments', NearestPaymentsDataservice::provideAllAgrData());
    }
}
