<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleNoteRequest;
use App\Models\VehicleNote;
use App\Models\VehicleType;

class VehicleNotesDataservice
{
    public static function provideData(): array
    {
        return ['note' => VehicleNote::all(), 'filter' => ''];
    }

    public static function provideEditor(VehicleNote $vehicleNote):array
    {
        return ['note'=>$vehicleNote, 'route'=>($vehicleNote->id)?'admin.addVehicleNote':'admin.addVehicleNote'];
    }

    public static function storeNew(VehicleNoteRequest $request)
    {
        $note = new VehicleNote();
        self::saveChanges($request, $note);
    }

    public static function saveChanges(VehicleNoteRequest $request, VehicleNote $vehicleNote)
    {
        $vehicleNote->fill($request->except(['id', 'created_at', 'updated_at']));
        if ($vehicleNote->id) $vehicleNote->updated_at = now();
        else $vehicleNote->created_at = now();

        $vehicleNote->save();
    }
}
