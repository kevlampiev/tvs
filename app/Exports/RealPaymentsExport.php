<?php

namespace App\Exports;

use App\Models\AgreementPayment;
use App\Models\RealPayment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RealPaymentsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $payments = RealPayment::all();
        return view('exports.real-payments', ['payments' => $payments]);
    }
}
