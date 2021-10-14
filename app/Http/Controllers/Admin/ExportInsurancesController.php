<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InsurancesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportInsurancesController extends Controller
{
    public function exportInsurances(): BinaryFileResponse
    {
        return Excel::download(new InsurancesExport, 'insurances.xlsx');
    }

}
