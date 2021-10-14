<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AgreementPaymentsExport;
use App\Exports\RealPaymentsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportPaymentsController extends Controller
{
    public function exportAgreementPayments(): BinaryFileResponse
    {
        return Excel::download(new AgreementPaymentsExport, 'agreement_payments.xlsx');
    }

    public function exportRealPayments(): BinaryFileResponse
    {
        return Excel::download(new RealPaymentsExport, 'real_payments.xlsx');
    }
}
