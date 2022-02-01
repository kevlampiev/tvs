<?php


namespace App\DataServices\Admin;


use App\Http\Requests\MessageRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Counterparty;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardDataservice
{

    public static function provideData():array
    {
//        dd(Carbon::now()->toDateString());
        $overdueTasks = Task::query()->where('task_performer_id', '=', Auth::user()->id)
            ->where('terminate_date', '=', null)
            ->where('due_date',"<", Carbon::now()->toDateString())
            ->where('parent_task_id','<>', null)
            ->orderBy('user_id')
            ->orderBy('due_date')
            ->get();
        $todaysTasks = Task::query()->where('task_performer_id', '=', Auth::user()->id)
            ->where('terminate_date', '=', null)
            ->where('due_date',"=", Carbon::now()->toDateString())
            ->where('parent_task_id','<>', null)
            ->orderBy('user_id')
            ->orderBy('due_date')
            ->get();
        $futureTasks = Task::query()->where('task_performer_id', '=', Auth::user()->id)
            ->where('terminate_date', '=', null)
            ->where('due_date',">", Carbon::now()->toDateString())
            ->where('parent_task_id','<>', null)
            ->orderBy('user_id')
            ->orderBy('due_date')
            ->get();

        $vehiclesWithoutPayment = Vehicle::query()
            ->where('purchase_date','<',Carbon::parse('01.01.2000'))
            ->orWhere('price','<',1000)->count();
        $row = DB::select('select id from vehicles where id not in (select vehicle_id from insurances)');

        $noDocsVehicles = DB::select('select id from vehicles where id not in (select distinct vehicle_id from documents)');
        $noAgrVehicles = DB::select('select id from vehicles where id not in (select distinct vehicle_id from agreement_vehicle)');
        $doubleVIN = DB::select('select vin, count(id) from vehicles group by vin having count(vin)>1');
        $lastMessages = Message::query()->orderByDesc('created_at')->limit(15)->get();


        return [
            'overdueTasks' =>$overdueTasks,
            'todaysTasks' => $todaysTasks,
            'futureTasks' => $futureTasks,
            'vehiclesWithoutPayment' => $vehiclesWithoutPayment,
            'vehiclesWithoutProperPrices' => $vehiclesWithoutPayment,
            'uninsuredVehiclesCount' => (count($row)),
            'vehiclesWithoutPassport' => count($noDocsVehicles),
            'lastMessages' => $lastMessages,
            'noAgrVehicles' => count($noAgrVehicles),
            'doubleVIN' => count($doubleVIN)
        ];

    }

}
