<?php


namespace App\DataServices\Admin;


use App\Http\Requests\DepositRequest;
use App\Http\Requests\PowerOfAttorneyRequest;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Deposit;
use App\Models\PowerOfAttorney;
use App\Models\Vehicle;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class POADataservice
{

    public static function provideEditor(PowerOfAttorney $powerOfAttorney): array
    {
        return [
            'powerOfAttorney' => $powerOfAttorney,
        ];
    }

    public static function create(Request $request, Company $company):PowerOfAttorney
    {
        $powerOfAttorney = new PowerOfAttorney();
        $powerOfAttorney->company_id = $company->id;
        $powerOfAttorney->date_open = Carbon::now()->toDateString();
        $powerOfAttorney->date_close = Carbon::now()->addYear()->toDateString();
        if (!empty($request->old())) {
            $powerOfAttorney->fill($request->old());
        }
        return $powerOfAttorney;
    }

    public static function edit(Request $request, Deposit $deposit)
    {
        if (!empty($request->old())) $deposit->fill($request->old());
    }

    public static function saveChanges(PowerOfAttorneyRequest $request, PowerOfAttorney $powerOfAttorney)
    {
        $powerOfAttorney->fill($request->all());
        if (!$powerOfAttorney->user_id) $powerOfAttorney->user_id = Auth::user()->id;
        if ($powerOfAttorney->id) $powerOfAttorney->updated_at = now();
        else $powerOfAttorney->created_at = now();
        $powerOfAttorney->save();
    }

    public static function store(PowerOfAttorneyRequest $request)
    {
        try {
            $powerOfAttorney = new PowerOfAttorney();
            self::saveChanges($request, $powerOfAttorney);
            session()->flash('message', 'Добавлена новая доверенность');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новую доверенность');
        }

    }

    public static function update(PowerOfAttorneyRequest $request, PowerOfAttorney $powerOfAttorney)
    {
        try {
            self::saveChanges($request, $powerOfAttorney);
            session()->flash('message', 'Данные о доверенности обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные доверенности');
        }
    }

    public static function delete(PowerOfAttorney $powerOfAttorney)
    {
        try {
            $powerOfAttorney->delete();
            session()->flash('message', 'Данные о доверенности удалены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить данные о доверенности');
        }
    }


}
