<?php


namespace App\DataServices;


use App\Models\Insurance;
use App\Models\InsuranceCompany;
use App\Models\InsuranceType;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InsurancesRepo
{
    static public function getInsurances(Request $request)
    {
        $filter = ($request->get('searchStr')) ? $request->get('searchStr') : '';
        if ($filter === '') {
            $insurances = Insurance::query()
//                ->with('type')
                ->orderByDesc('date_open')
                ->paginate(15);
        } else {
            $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
            $insurances = Insurance::query()
//                ->with('type')
                ->orWhereHas('insuranceCompany', function (Builder $query) use ($searchStr) {
                    $query->where('name', 'like', $searchStr);
                })
                ->orWhereHas('type', function (Builder $query) use ($searchStr) {
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


//    //TODO переделать метод через Eloquent для архитектурной чистоты
//
//    /**
//     * Метод наполнения данными view добавления к договору новой единицы теники
//     */
//    public static function provideAddVehicleView(Agreement $agreement): array
//    {
//
//        $presentedVehicles =
//            DB::select('select vehicle_id from agreement_vehicle where agreement_id=?', [$agreement->id]);
//
//        $data = [];
//        foreach ($presentedVehicles as $el) {
//            $data[] = $el->vehicle_id;
//        }
//        $vehicles = Vehicle::query()->whereNotIn('id', $data)->orderBy('name')->get();
//        return [
//            'agreement' => $agreement,
//            'vehicles' => $vehicles
//        ];
//    }
//
//    /**
//     *Добавляет много периодических записей о предстоящих платежах
//     * @return void
//     */
//    public static function addManyPayments(Request $request, Agreement $agreement)
//    {
//        $repeatCount = $request->post('repeat_count');
//        $dateStart = $request->post('date_start');
//        $payments = [];
//        for ($i = 0; $i < $repeatCount; $i++) {
//            $payments[] = [
//                'agreement_id' => $agreement->id,
//                'payment_date' => Carbon::create($dateStart)->addMonths($i),
//                'amount' => $request->post('amount'),
//                'currency' => $request->post('currency')
//            ];
//        }
//        AgreementPayment::insert($payments);
//    }
}
