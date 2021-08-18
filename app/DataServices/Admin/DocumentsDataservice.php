<?php


namespace App\DataServices\Admin;


use App\Models\AgreementType;
use App\Models\Document;
use App\Models\InsuranceType;
use App\Models\VehicleType;

class DocumentsDataservice
{
    public static function provideDataVehicle(Vehicle $vehicle): array
    {
        $data = Document::query()->where('vehicle_id','=', $vehicle->id)
            ->with('user')
            ->get();

        return $data;
    }
}
