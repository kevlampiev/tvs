<?php

namespace App\Exports;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VehiclesExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $vehicles = Vehicle::all();
        return view('exports.vehicles', ['vehicles' => $vehicles]);
    }
}
