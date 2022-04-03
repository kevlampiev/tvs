<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\GlobalSearchDataService;
use App\Exports\AgreementsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class GlobalSearchController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('globalSearch')??'';
        return view('Admin.big-search-results', GlobalSearchDataService::provideData($filter));
    }

}
