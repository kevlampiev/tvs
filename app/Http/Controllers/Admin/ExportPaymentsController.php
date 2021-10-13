<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AgreementPaymentsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportPaymentsController extends Controller
{
    public function export()
    {
        return Excel::download(new AgreementPaymentsExport, 'agreement_payments.xlsx');
    }
}
