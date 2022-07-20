<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleLocationRequest;
use App\Http\Requests\VehiclePlacementRequest;
use App\Models\AgreementType;
use App\Models\Vehicle;
use App\Models\VehicleLocation;
use App\Models\VehiclePlacement;
use Error;
use Illuminate\Http\Request;

class VehiclePlacementDataservice
{
    public static function provideData(VehiclePlacement $placement): array
    {

        return ['placement' => $placement,
            'locations' => VehicleLocation::query()->orderBy('name')->get()];
    }


    public static function create(Request $request, Vehicle $vehicle): VehiclePlacement
    {
        $placement = new VehiclePlacement();
        if (!empty($request->old())) $placement->fill($request->old());
        $placement->vehicle_id = $vehicle->id;
        return $placement;
    }

    public static function edit(Request $request, VehiclePlacement $placement)
    {
        if (!empty($request->old())) $placement->fill($request->old());
    }


    public static function saveChanges(VehiclePlacementRequest $request, VehiclePlacement $placement)
    {
        $placement->fill($request->all());
        if ($placement->id) $placement->updated_at = now();
        else $placement->created_at = now();
        $placement->save();
    }

    public static function store(VehiclePlacementRequest $request)
    {
        try {
            $placement = new VehiclePlacement();
            self::saveChanges($request, $placement);
            session()->flash('message', 'Добавлено новое место дислокации единицы техники');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новое место дисклокации единицы техники');
        }

    }

    public static function update(VehiclePlacementRequest $request, VehiclePlacement $placement)
    {
        try {
            self::saveChanges($request, $placement);
            session()->flash('message', 'Данные места дислокации техники обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные места дислокации техники');
        }
    }

    public static function delete(VehiclePlacement $placement)
    {
        try {
            $placement->delete();
            session()->flash('message', 'Удалено место дислокации техники');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить место дислокации техники');
        }
    }

}
