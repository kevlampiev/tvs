<?php


namespace App\DataServices\User;


use Illuminate\Support\Facades\DB;

class InsurancesDataservice
{
    /**
     * Выдает данные в зависимости от типа параметра 1 - группировка по страховщикам, 2- по типам страховок
     */
    public static function provideData(int $reportType = 1): array
    {
        $queryStr = 'select * from v_insurances_most_actual where date_close>=current_date order by insurance_company, insurance_type';
        $data = collect(DB::select($queryStr));
        if ($reportType == 1) $data = $data->groupBy('insurance_company')->all();
        else $data = $data->groupBy('insurance_type')->all();

        return ['actualInsurances' => $data];
    }

    /**
     *Все последние страховки + техника без страховок
     */
    public static function getActualInsurances(): array
    {
        $data = collect(DB::select('select * from v_all_vehicles_with_insurances vavwi order by insurance_type, date_close desc, vehicle, insurance_company'));
        $insurances = $data->groupBy('insurance_type');
        return ['insurances'=>$insurances];
    }

}
