<?php


namespace App\DataServices\Admin;


use App\Models\VehicleNote;
use App\Models\VehicleType;

class VehicleNotesDataservice
{
    public static function provideData(): array
    {
        return ['note' => VehicleNote::all(), 'filter' => ''];
    }

    public static function provideEditor(VehicleNote $note):array
    {
        return ['note'=>$note];
    }
}
