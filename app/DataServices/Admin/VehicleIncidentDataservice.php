<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleIncidentRequest;
use App\Http\Requests\VehicleNoteRequest;
use App\Models\VehicleIncident;
use App\Models\VehicleNote;
use Illuminate\Support\Facades\Auth;
use PhpParser\Error;

class VehicleIncidentDataservice
{
//    public static function provideData(): array
//    {
//        return ['notes' => VehicleNote::all(), 'filter' => ''];
//    }

    public static function provideEditor(VehicleIncident $vehicleIncident): array
    {
        return ['vehicleIncident' => $vehicleIncident];
    }

    public static function storeNew(VehicleIncidentRequest $request)
    {
        $vehicleIncident = new VehicleIncident();
        self::saveChanges($request, $vehicleIncident);
    }

    public static function update(VehicleIncidentRequest $request, VehicleIncident $vehicleIncident)
    {
        self::saveChanges($request, $vehicleIncident);
    }

    public static function saveChanges(VehicleIncidentRequest $request, VehicleIncident $vehicleIncident)
    {
        $vehicleIncident->fill($request->all());
        if ($vehicleIncident->id) $vehicleIncident->updated_at = now();
        else $vehicleIncident->created_at = now();

        try {
            $vehicleIncident->save();
            session()->flash('message', 'Данные об инциденте сохранены');
        } catch (Error $err) {
            session()->flash('error', 'Ошибка сохранения данных об инциденте');
        }
    }

    public static function erase(VehicleIncident $vehicleIncident)
    {
        try {
            $vehicleIncident->delete();
            session()->flash('message', 'Данные об инциденте удалены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить данные об инциденте');
        }
    }
}
