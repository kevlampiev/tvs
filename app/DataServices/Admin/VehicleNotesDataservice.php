<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleNoteRequest;
use App\Models\VehicleNote;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Auth;
use PhpParser\Error;

class VehicleNotesDataservice
{
    public static function provideData(): array
    {
        return ['notes' => VehicleNote::all(), 'filter' => ''];
    }

    public static function provideEditor(VehicleNote $vehicleNote): array
    {
        return ['vehicleNote' => $vehicleNote, 'route' => ($vehicleNote->id) ? 'admin.addVehicleNote' : 'admin.addVehicleNote'];
    }

    public static function storeNew(VehicleNoteRequest $request)
    {
        $note = new VehicleNote();
        self::saveChanges($request, $note);
    }

    public function update(VehicleNoteRequest $request, VehicleNote $vehicleNote)
    {
        self::saveChanges($request, $vehicleNote);
    }

    public static function saveChanges(VehicleNoteRequest $request, VehicleNote $vehicleNote)
    {
        $vehicleNote->fill($request->except(['id', 'created_at', 'updated_at', 'vehicleNode']));
        if (!$vehicleNote->user_id) $vehicleNote->user_id = Auth::user()->id;
        if ($vehicleNote->id) $vehicleNote->updated_at = now();
        else $vehicleNote->created_at = now();

        try {
            $vehicleNote->save();
            session()->flash('message', 'Данные заметки сохранены');
        } catch (Error $err) {
            session()->flash('error', 'Ошибка сохранения данных о заметке');
        }
    }

    public static function erase(VehicleNote $vehicleNote)
    {
        try {
            $vehicleNote->delete();
            session()->flash('message', 'Заметка удалена');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить заметку');
        }
    }
}
