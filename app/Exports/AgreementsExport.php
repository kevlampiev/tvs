<?php

namespace App\Exports;

use App\Models\Agreement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AgreementsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $agreements = Agreement::all();
        return view('exports.agreements', ['agreements' => $agreements]);
    }
}
