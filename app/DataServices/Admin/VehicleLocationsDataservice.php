<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleLocationRequest;
use App\Models\AgreementType;
use App\Models\VehicleLocation;
use Error;
use Illuminate\Http\Request;

class VehicleLocationsDataservice
{
    public static function provideData(): array
    {
        return ['agrTypes' => AgreementType::withCount('agreements')->orderBy('name')->get(), 'filter' => ''];
    }


    public static function create(Request $request): VehicleLocation
    {
        $location = new VehicleLocation();
        if (!empty($request->old())) $location->fill($request->old());

        return $location;
    }

    public static function edit(Request $request, VehicleLocation $location)
    {
        if (!empty($request->old())) $location->fill($request->old());
    }


    public static function saveChanges(VehicleLocationRequest $request, VehicleLocation $location)
    {
        $location->fill($request->all());
        if ($location->id) $location->updated_at = now();
        else $location->created_at = now();
        $location->save();
    }

    public static function store(VehicleLocationRequest $request)
    {
        try {
            $location = new VehicleLocation();
            self::saveChanges($request, $location);
            session()->flash('message', 'Добавлено новое место дислокации техники');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новое место дисклокации техники');
        }

    }

    public static function update(VehicleLocationRequest $request, VehicleLocation $location)
    {
        try {
            self::saveChanges($request, $location);
            session()->flash('message', 'Данные места дислокации техники обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные места дислокации техники');
        }
    }

    public static function delete(VehicleLocation $location)
    {
        try {
            $location->delete();
            session()->flash('message', 'Удалено место дислокации техники');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить место дислокации техники');
        }
    }

}
