<?php


namespace App\DataServices\Admin;


use App\Http\Requests\DepositRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Deposit;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositDataservice
{

    public static function provideEditor(Request $request, Agreement $agreement, Deposit $deposit=null): array
    {
        $depo = $deposit??self::create($request, $agreement, null);
        return [
            'deposit' => $depo,
            'agreement' => $agreement,
            'vehicles' => Vehicle::all()
        ];
    }

    public static function provideVehicleEditor(Request $request, Vehicle $vehicle, Deposit $deposit=null): array
    {
        $agreement = Agreement::query()->where('real_date_close','<>', null)->first();
        $depo = $deposit??self::create($request, $agreement, $vehicle);
        return [
            'deposit' => $depo,
            'agreements' => Agreement::all(),
        ];
    }


    public static function create(Request $request, Agreement $agreement, Vehicle $vehicle=null)
    {
        $deposit = new Deposit();
        $deposit->agreement_id = $agreement?$agreement->id:null;
        $deposit->vehicle_id = $vehicle?$vehicle->id:null;
        $deposit->date_open = Carbon::now()->toDateString();
        $deposit->date_close = Carbon::now()->addYear()->toDateString();
        if (!empty($request->old())) {
            $agreement->fill($request->old());
        }
        return $deposit;
    }

    public static function edit(Request $request, Deposit $deposit)
    {
        if (!empty($request->old())) $deposit->fill($request->old());
    }

    public static function saveChanges(DepositRequest $request, Deposit $deposit)
    {
        $deposit->fill($request->all());
        if (!$deposit->user_id) $deposit->user_id = Auth::user()->id;
        if ($deposit->id) $deposit->updated_at = now();
        else $deposit->created_at = now();
        $deposit->save();
    }

    public static function store(DepositRequest $request)
    {
        try {
            $deposit = new Deposit();
            self::saveChanges($request, $deposit);
            session()->flash('message', 'Добавлен новый залог по договору');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новый залог по договору');
        }

    }

    public static function update(DepositRequest $request, Deposit $deposit)
    {
        try {
            self::saveChanges($request, $deposit);
            session()->flash('message', 'Данные залога обновлены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные залога');
        }
    }

    public static function delete(Deposit $deposit)
    {
        try {
            $deposit->delete();
            session()->flash('message', 'Данные о залоге удалены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить данные о залоге');
        }
    }


}
