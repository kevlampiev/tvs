<?php

namespace App\Exports;

use App\Models\AgreementPayment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AgreementPaymentsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $payments = AgreementPayment::all();
        return view('exports.agreement-payments', ['payments' => $payments]);
    }
}
