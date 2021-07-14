<?php


namespace App\DataServices\Admin;


use App\Models\AgreementType;
use App\Models\InsuranceType;
use App\Models\VehicleType;

class InsuranceTypesDataservice
{
    public static function provideData(): array
    {
        return ['insuranceTypes' => InsuranceType::withCount('insurances')->orderBy('name')->get(), 'filter' => ''];
    }
}
