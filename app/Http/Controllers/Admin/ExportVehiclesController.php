<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VehiclesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportVehiclesController extends Controller
{
    public function exportVehicles(): BinaryFileResponse
    {
        return Excel::download(new VehiclesExport, 'vehicles.xlsx');
    }

}
