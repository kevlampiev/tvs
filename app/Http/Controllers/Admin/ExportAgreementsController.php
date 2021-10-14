<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AgreementsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportAgreementsController extends Controller
{
    public function exportAgreements(): BinaryFileResponse
    {
        return Excel::download(new AgreementsExport(), 'agreements.xlsx');
    }

}
