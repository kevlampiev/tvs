<?php


namespace App\DataServices\Admin;


use App\Http\Requests\AgreementRequest;
use App\Models\Agreement;
use App\Models\AgreementType;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementsDataservice
{
    /**
     *Получение всех договоров
     */
    public static function getAll()
    {
        return Agreement::query()
            ->orderBy('Company_id')
            ->orderByDesc('date_open')
            ->paginate(15);
    }

    /**
     * получение договоров, если установлен фильтр
     */
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

    /**
     * получение договоров в зависимтости от условий
     */
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

    /**
     *снабжение данными форму редактирования договора
     */
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

    /**
     * снабжение данными формы добавления техники к договору
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


    public static function create(Request $request):Agreement
    {
        $agreement = new Agreement();
        if (!empty($request->old())) $agreement->fill($request->old());
        return $agreement;
    }

    public static function edit(Request $request, Agreement $agreement)
    {
        if (!empty($request->old())) $agreement->fill($request->old());
    }

    public static function saveChanges(AgreementRequest $request, Agreement $agreement)
    {
        $agreement->fill($request->except(['agreement_file']));
        if(!$agreement->user_id) $agreement->user_id = Auth::user()->id;
        if ($agreement->id) $agreement->updated_at = now();
        else $agreement->created_at = now();
        if ($request->file('agreement_file')) {
            $file_path = $request->file('agreement_file')->store(config('paths.documents.put', '/public/agreements'));
            $agreement->file_name = basename($file_path);
        }
        $agreement->save();
    }

    public static function store(AgreementRequest $request)
    {
        try {
            $agreement = new Agreement();
            self::saveChanges($request, $agreement);
            session()->flash('message','Добавлен новый договор');
        } catch (Error $err) {
            session()->flash('error','Не удалось добавить новый договор');
        }

    }

    public static function update(AgreementRequest $request, Agreement $agreement)
    {
        try {
            self::saveChanges($request, $agreement);
            session()->flash('message','Данные договора обновлены');
        } catch (Error $err) {
            session()->flash('error','Не удалось обновить данные договора');
        }
    }

    //TODO Надо еще и файл удалить при удалении записи о договоре
    public static function delete(Agreement $agreement)
    {
        try {
            $agreement->delete();
            session()->flash('message','Договор удален');
        } catch (Error $err) {
            session()->flash('error','Не удалось удалить договор');
        }
    }

}
