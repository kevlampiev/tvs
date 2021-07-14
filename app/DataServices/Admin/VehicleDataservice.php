<?php


namespace App\DataServices\Admin;


use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleType;

class VehicleDataservice
{
    public static function provideData(): array
    {
        return ['vehicles' => Vehicle::withCount('agreements')->orderBy('name')->get(), 'filter' => ''];
    }

    public static function provideEditorForm(Vehicle $vehicle):array
    {
        return [
            'vehicle' => $vehicle,
            'route' => 'admin.editVehicle',
            'vehicleTypes' => VehicleType::query()->orderBy('name')->get(),
            'manufacturers' => Manufacturer::query()->orderBy('name')->get(),
        ];
    }

}
