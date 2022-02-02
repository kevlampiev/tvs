<?php


namespace App\DataServices\Admin;


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

    public static function provideEditor(Agreement $agreement): array
    {
        $deposit = new Deposit();
        $deposit->agreement_id = $agreement->id;
        return [
            'deposit' => $deposit,
            'agreement' => $agreement,
            'vehicles' => Vehicle::all()
        ];

    }

}
