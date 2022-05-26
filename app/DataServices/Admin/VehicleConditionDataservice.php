<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleConditionRequest;
use App\Http\Requests\VehicleIncidentRequest;
use App\Http\Requests\VehicleNoteRequest;
use App\Models\VehicleCondition;
use App\Models\VehicleIncident;
use App\Models\VehicleNote;
use Illuminate\Support\Facades\Auth;
use PhpParser\Error;

class VehicleConditionDataservice
{
    public static function provideEditor(VehicleCondition $vehicleCondition): array
    {
        return ['vehicleCondition' => $vehicleCondition];
    }

    public static function storeNew(VehicleConditionRequest $request)
    {
        $vehicleCondition = new VehicleCondition();
        self::saveChanges($request, $vehicleCondition);
    }

    public static function update(VehicleConditionRequest $request, VehicleCondition $vehicleCondition)
    {
        self::saveChanges($request, $vehicleCondition);
    }

    public static function saveChanges(VehicleConditionRequest $request, VehicleCondition $vehicleCondition)
    {
        $vehicleCondition->fill($request->all());
        if ($vehicleCondition->id) $vehicleCondition->updated_at = now();
        else $vehicleCondition->created_at = now();

        try {
            $vehicleCondition->save();
            session()->flash('message', 'Состояние техники изменено');
        } catch (Error $err) {
            session()->flash('error', 'Ошибка сохранения данных о состоянии техники');
        }
    }

    public static function erase(VehicleCondition $vehicleCondition)
    {
        try {
            $vehicleCondition->delete();
            session()->flash('message', 'Данные о состоянии удалены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить данные о состоянии');
        }
    }
}
