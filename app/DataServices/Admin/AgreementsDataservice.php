<?php


namespace App\DataServices\Admin;


use App\Models\Agreement;
use App\Models\AgreementType;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Vehicle;
use App\Models\VehicleType;
use http\Env\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementsDataservice
{
    public static function getAll()
    {
        return Agreement::query()
            ->orderBy('Company_id')
            ->orderByDesc('date_open')
            ->paginate(15);
    }

    public static function getFiltered(str $filter)
    {
        $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
        $agreements = Agreement::query()
            ->where('name', 'like', $searchStr)
            ->orWhere('agr_number', 'like', $searchStr)
            ->orWhereHas('Company', function (Builder $query) use ($searchStr) {
                $query->where('name', 'like', $searchStr);
            })
            ->orWhereHas('Counterparty', function (Builder $query) use ($searchStr) {
                $query->where('name', 'like', $searchStr);
            })
            ->orWhereHas('AgreementType', function (Builder $query) use ($searchStr) {
                $query->where('name', 'like', $searchStr);
            })
            ->orderByDesc('date_open')
            ->paginate(15);

        return $agreements;
    }

    public static function index(Request $request): array
    {
        $filter = ($request->get('searchStr')) ?? '';
        if ($filter!=='') $agreements=self::getAll();
        else $agreements = self::getFiltered($filter);
        return [
            'agreements' => $agreements,
            'filter' => $filter
        ];
    }

    public static function provideAgreementEditor(Agreement $agreement, $routeName): array
    {
        return [
            'agreement' => $agreement,
            'route' => $routeName,
            'agreementTypes' => AgreementType::query()->orderBy('name')->get(),
            'companies' => Company::query()->orderBy('name')->get(),
            'counterparties' => Counterparty::query()->orderBy('name')->get(),
        ];
    }

    public static function provideAddVehicleView(Agreement $agreement): array
    {

        $presentedVehicles =
            DB::select('select vehicle_id from agreement_vehicle where agreement_id=?', [$agreement->id]);

        $data = [];
        foreach ($presentedVehicles as $el) {
            $data[] = $el->vehicle_id;
        }
        $vehicles = Vehicle::query()->whereNotIn('id', $data)->orderBy('name')->get();
        return [
            'agreement' => $agreement,
            'vehicles' => $vehicles
        ];
    }


}
