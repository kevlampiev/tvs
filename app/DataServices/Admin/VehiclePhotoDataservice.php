<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleNoteRequest;
use App\Http\Requests\VehiclePhotoAddRequest;
use App\Http\Requests\VehiclePhotoEditRequest;
use App\Models\VehicleNote;
use App\Models\VehiclePhoto;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Error;

class VehiclePhotoDataservice
{
    public static function provideData(): array
    {
        return ['photos' => VehiclePhoto::all(), 'filter' => ''];
    }

    public static function provideEditor(VehiclePhoto $vehiclePhoto): array
    {
        return ['vehiclePhoto' => $vehiclePhoto,
            'route' => ($vehiclePhoto->id) ? route('admin.editVehiclePhoto', ['vehiclePhoto'=>$vehiclePhoto]) :
                route('admin.addVehiclePhoto', ['vehicle'=>$vehiclePhoto->vehicle_id])];
    }

    public static function storeNew(VehiclePhotoAddRequest $request)
    {
        $photo = new VehiclePhoto();
        self::saveChanges($request, $photo);
    }

    public static function update(VehiclePhotoEditRequest $request, VehiclePhoto $vehiclePhoto)
    {
        self::saveChanges($request, $vehiclePhoto);
    }

    public static function saveChanges($request, VehiclePhoto $vehiclePhoto)
    {
        $vehiclePhoto->fill($request->except(['id', 'created_at', 'updated_at']));
        if ($vehiclePhoto->id) $vehiclePhoto->updated_at = now();
        else $vehiclePhoto->created_at = now();
        if ($request->file('img_file')) {
            $file_path = $request->file('img_file')->store(config('paths.vehicles.put', 'public/img/vehicles'));
            $vehiclePhoto->img_file = basename($file_path);
        }

        try {
            $vehiclePhoto->save();
            session()->flash('message', 'Фотография сохранена');
        } catch (Error $err) {
            session()->flash('error', 'Ошибка сохранения фотографии');
        }
    }

    public static function erase(VehiclePhoto $vehiclePhoto)
    {
        try {
            Storage::delete('public/img/vehicles/'.$vehiclePhoto->img_file);
            $vehiclePhoto->delete();
            session()->flash('message', 'Фотография удалена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить фотографию');
        }
    }
}
