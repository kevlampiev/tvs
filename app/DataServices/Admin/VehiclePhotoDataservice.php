<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleNoteRequest;
use App\Http\Requests\VehiclePhotoAddRequest;
use App\Http\Requests\VehiclePhotoEditRequest;
use App\Models\VehicleNote;
use App\Models\VehiclePhoto;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Error;

class VehiclePhotoDataservice
{
    public static function provideData(): array
    {
        return ['photos' => VehiclePhoto::all(), 'filter' => ''];
    }

    public static function provideEditor(VehiclePhoto $vehiclePhoto): array
    {
        return ['vehiclePhoto' => $vehiclePhoto, 'route' => ($vehiclePhoto->id) ? 'admin.editVehiclePhoto' : 'admin.addVehiclePhoto'];
    }

    public static function storeNew(Request $request)
    {
        $photo = new VehiclePhoto();
        self::saveChanges($request, $photo);
    }

    public static function update(Request $request, VehiclePhoto $vehiclePhoto)
    {
        self::saveChanges($request, $vehiclePhoto);
    }

    public static function saveChanges(Request $request, VehiclePhoto $vehiclePhoto)
    {
        $vehiclePhoto->fill($request->except(['id', 'created_at', 'updated_at']));
        if ($vehiclePhoto->id) $vehiclePhoto->updated_at = now();
        else $vehiclePhoto->created_at = now();

        try {
            $vehiclePhoto->save();
            session()->flash('message', 'Фотография сохранена');
        } catch (Error $err) {
            session()->flash('error', 'Ошибка сохранения фотографии');
        }
    }

    //TODO реализовать удаление файла неиспользуемого файла
    public static function erase(VehiclePhoto $vehiclePhoto)
    {
        try {
            $vehiclePhoto->delete();
            session()->flash('message', 'Фотография удалена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить фотографию');
        }
    }
}
