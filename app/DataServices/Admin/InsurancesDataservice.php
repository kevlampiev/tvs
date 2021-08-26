<?php


namespace App\DataServices\Admin;


use App\Http\Requests\InsuranceRequest;
use App\Models\Insurance;
use App\Models\InsuranceCompany;
use App\Models\InsuranceType;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InsurancesDataservice
{
    static public function index(Request $request)
    {
        $filter = ($request->get('searchStr')) ? $request->get('searchStr') : '';
        if ($filter === '') {
            $insurances = Insurance::query()
                ->with('insuranceType')
                ->orderByDesc('date_open')
                ->paginate(15);
        } else {
            $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
            $insurances = Insurance::query()
                ->with('insuranceType')
                ->orWhereHas('insuranceCompany', function (Builder $query) use ($searchStr) {
                    $query->where('name', 'like', $searchStr);
                })
                ->orWhereHas('insuranceType', function (Builder $query) use ($searchStr) {
                    $query->where('name', 'like', $searchStr);
                })
                ->orWhereHas('vehicle', function (Builder $query) use ($searchStr) {
                    $query->where('name', 'like', $searchStr);
                })
                ->orderByDesc('date_open')
                ->paginate(15);
        }
        return ['insurances' => $insurances,
            'filter' => $filter];
    }

    public static function provideInsuranceEditor(Insurance $insurance, $routeName): array
    {
        return [
            'insurance' => $insurance,
            'route' => $routeName,
            'vehicles' => Vehicle::query()->orderBy('name')->get(),
            'insuranceCompanies' => InsuranceCompany::query()->orderBy('name')->get(),
            'insTypes' => InsuranceType::query()->orderBy('name')->get(),
        ];
    }


    public static function defaultData(Vehicle $vehicle = null): array
    {
        return [
            'vehicle_id' => $vehicle ? $vehicle->id : null,
            'date_open' => Carbon::today()->toDateString(),
            'date_close' => Carbon::today()->addYear()->toDateString(),
            'description' => 'Страхуемые риски: ущерб, хищение',
            'created_at' => Carbon::today()->toDateString(),
        ];
    }

    public static function create(Request $request, Vehicle $vehicle = null): Insurance
    {
        $insurance = new Insurance();
        if (!empty($request->old())) $insurance->fill($request->old());
        else $insurance->fill(self::defaultData($vehicle));
        return $insurance;
    }

    public static function edit(Request $request, Insurance $insurance)
    {
        if (!empty($request->old())) $insurance->fill($request->old());
    }


    public static function saveChanges(InsuranceRequest $request, Insurance $insurance)
    {
        $insurance->fill($request->except(['policy_file']));
        if ($insurance->id) $insurance->updated_at = now();
        else $insurance->created_at = now();
        if ($request->file('policy_file')) {
            $file_path = $request->file('policy_file')->store(config('paths.insurances.put', '/public/insurances'));
            $insurance->policy_file = basename($file_path);
        }
        $insurance->save();
    }

    public static function store(InsuranceRequest $request)
    {
        try {
            $insurance = new Insurance();
            self::saveChanges($request, $insurance);
            session()->flash('message', 'Добавлен новый договор страхования');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новый договор страхования');
        }

    }

    public static function update(InsuranceRequest $request, Insurance $insurance)
    {
        try {
            self::saveChanges($request, $insurance);
            session()->flash('message', 'Данные договора страхования обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные договора страхования');
        }
    }

    public static function delete(Insurance $insurance)
    {
        try {
            $insurance->delete();
            session()->flash('message', 'Договор страхования удален');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить договор страхования');
        }
    }


}
