<?php


namespace App\DataServices\Admin;


use App\Models\Company;

class CompaniesDataservice
{
    public static function provideData(): array
    {
        return ['companies' => Company::withCount('agreements')
            ->orderBy('name')->get(), 'filter' => ''];
    }
}
