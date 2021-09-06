<?php


namespace App\DataServices\Admin;


use App\Models\InsuranceType;

class InsuranceTypesDataservice
{
    public static function provideData(): array
    {
        return ['insuranceTypes' => InsuranceType::withCount('insurances')->orderBy('name')->get(), 'filter' => ''];
    }
}
