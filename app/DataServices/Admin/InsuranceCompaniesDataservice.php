<?php


namespace App\DataServices\Admin;


use App\Models\InsuranceCompany;

class InsuranceCompaniesDataservice
{
    public static function provideData(): array
    {
        return ['insuranceCompanies' => InsuranceCompany::withCount('insurances')->orderBy('name')->get(), 'filter' => ''];
    }
}
