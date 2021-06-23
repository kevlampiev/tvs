<?php


namespace App\Repositories;


use App\Models\Agreement;
use App\Models\AgreementType;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgreementsRepo
{
    static public function getAgreements(Request $request)
    {
        $filter = ($request->get('searchStr')) ? $request->get('searchStr') : '';
        if ($filter === '') {
            $agreements = Agreement::query()
                ->orderBy('Company_id')
                ->orderBy('Counterparty_id')
                ->paginate(15);
        } else {
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
                ->orderBy('Company_id')
                ->orderBy('Counterparty_id')
                ->orderBy('date_open')
                ->paginate(15);
        }
        return ['agreements' => $agreements,
            'filter' => $filter];
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


    //TODO переделать метод через Eloquent для архитектурной чистоты

    /**
     * Метод наполнения данными view добавления к договору новой единицы теники
     */
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
