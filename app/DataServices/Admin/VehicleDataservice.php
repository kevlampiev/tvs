<?php


namespace App\DataServices\Admin;


use App\Http\Requests\VehicleRequest;
use App\Models\Agreement;
use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Error;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleDataservice
{

    public static function getAll()
    {
        return Vehicle::query()->orderBy('name')->paginate(15);
    }

    public static function getFiltered(string $filter)
    {
        $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
        $vehicles = Vehicle::query()
            ->where('name', 'like', $searchStr)
            ->orWhere('VIN', 'like', $searchStr)
            ->orWhere('bort_number', 'like', $searchStr)
            ->orWhere('model', 'like', $searchStr)
            ->orWhere('trademark', 'like', $searchStr)
            ->orWhereHas('VehicleType', function (Builder $query) use ($searchStr) {
                $query->where('name', 'like', $searchStr);
            })
            ->orWhereHas('Manufacturer', function (Builder $query) use ($searchStr) {
                $query->where('name', 'like', $searchStr);
            })
            ->paginate(15);
        return $vehicles;
    }

    public static function index(Request $request)
    {
        $filter = ($request->get('searchStr')) ?? '';
        if ($filter === '') $vehicles = self::getAll();
        else $vehicles = self::getFiltered($filter);
        return [
            'vehicles' => $vehicles,
            'filter' => $filter
        ];
    }


    public static function provideData(): array
    {
        return ['vehicles' => Vehicle::withCount('agreements')->orderBy('name')->get(), 'filter' => ''];
    }

    public static function provideEditorForm(Vehicle $vehicle): array
    {
        return [
            'vehicle' => $vehicle,
            'route' => ($vehicle->id) ? 'admin.editVehicle' : 'admin.addVehicle',
            'vehicleTypes' => VehicleType::query()->orderBy('name')->get(),
            'manufacturers' => Manufacturer::query()->orderBy('name')->get(),
        ];
    }

    /**
     * Метод наполнения данными view добавления к единице техники договоров
     * @param Vehicle $vehicle
     * @return array
     */
    public static function provideAddAgreementView(Vehicle $vehicle): array
    {
        $presentedAgreements =
            DB::select('select agreement_id from agreement_vehicle where vehicle_id=?', [$vehicle->id]);

        $data = [];
        foreach ($presentedAgreements as $el) {
            $data[] = $el->agreement_id;
        }
        $agreements = Agreement::query()->whereNotIn('id', $data)->orderBy('name')->get();
        return [
            'vehicle' => $vehicle,
            'agreements' => $agreements
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
        $vehicle->fill($request->except(['id', 'created_at', 'updated_at', 'pts-img', 'img_file']));
        if ($vehicle->id) $vehicle->updated_at = now();
        else $vehicle->created_at = now();
        if (!$vehicle->user_id) $vehicle->user_id = Auth::user()->id;
        if ($request->file('img_file')) {
            $file_path = $request->file('img_file')->store(config('paths.vehicles.put', 'public/img/vehicles'));
            $vehicle->img_file = basename($file_path);
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

    public static function attachAgreement(Request $request, Vehicle $vehicle)
    {
        try {
            $agreement = Agreement::find($request->agreement_id);
            $vehicle->agreements()->save($agreement);
            session()->flash('message', 'Договор привязан к технике');
        } catch (Error $err) {
            session()->flash('error', 'Невозможно связать договор и технику');
        }
    }

    public static function detachAgreements(Vehicle $vehicle, Agreement $agreement)
    {
        try {
            $vehicle->agreements()->detach($agreement);
            session()->flash('message', 'Договор отвязан от техники');
        } catch (Error $err) {
            session()->flash('error', 'Невозможно связать договор и технику');
        }
    }

}
