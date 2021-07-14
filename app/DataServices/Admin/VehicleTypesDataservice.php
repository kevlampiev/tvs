<?php


namespace App\DataServices\Admin;


use App\Models\VehicleType;

class VehicleTypesDataservice
{
    public static function provideData(): array
    {
        return ['vehicleTypes' => VehicleType::withCount('vehicles')->orderBy('name')->get(), 'filter' => ''];
    }
}