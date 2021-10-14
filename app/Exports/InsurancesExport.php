<?php

namespace App\Exports;

use App\Models\Insurance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InsurancesExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $insurances = Insurance::all();
        return view('exports.insurances', ['insurances' => $insurances]);
    }
}
