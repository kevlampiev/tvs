<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\NearestPaymentsRepo;
use Illuminate\Http\Request;

class NearestPaymentsController extends Controller
{
    public function showAllAgr()
    {
        return view('User.NearestPayments', NearestPaymentsRepo::provideAllAgrData());
    }
}
