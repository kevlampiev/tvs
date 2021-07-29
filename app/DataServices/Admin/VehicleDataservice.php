<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleRequest;
use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

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
            'route' => ($vehicle->id)?'admin.editVehicle':'admin.addVehicle',
            'vehicleTypes' => VehicleType::query()->orderBy('name')->get(),
            'manufacturers' => Manufacturer::query()->orderBy('name')->get(),
        ];
    }

    public static function storeNewVehicle(VehicleRequest $request)
    {
        $vehicle = new Vehicle();
        self::saveChanges($request, $vehicle);

    }

    public static function updateVehicle(VehicleRequest $request, Vehicle $vehicle)
    {
        self::saveChanges($request, $vehicle);
    }

    public static function saveChanges(VehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->fill($request->except(['id', 'created_at', 'updated_at', 'pts-img']));
        if ($vehicle->id) $vehicle->updated_at = now();
            else $vehicle->created_at = now();
        if ($request->file('pts-img')) {
            $file_path = $request->file('pts-img')->store(config('paths.pts.put','/img/pts'));
            $vehicle->pts_img_path = basename($file_path);
        }
        $vehicle->save();
    }

    public static function erase(Vehicle $vehicle)
    {
        try {
            $vehicle->delete();
            session()->flash('message', 'Единица техники удалена');
        } catch (\Error $err) {
            session()->flash('error', 'Невозможно удалить запись');
        }
    }

}
