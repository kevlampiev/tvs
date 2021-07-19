<?php


namespace App\DataServices\Admin;


use App\Models\Agreement;
use App\Models\BankStatementPosition;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BankStatementDataservice
{
    public static function provideData():array
    {
        $data = collect(DB::select('SELECT bs.*, a.agr_number, a.date_open agr_date
                    FROM bank_statement_positions bs
                    LEFT JOIN agreements a ON bs.description LIKE CONCAT(\'%\',a.agr_number,\'%\')
                    WHERE bs.user_id=?
                    ', [Auth::user()->id]));
        return ['bankStatementPositions' => $data];
    }

    /**
     * Функция закачки данных о совершенных банковских операциях в промежуточную таблицу
     *return void
     */
    public static function storeData(array $data)
    {
        DB::transaction( function() use($data){
            foreach ($data as $item) {
                $bankOperation = new BankStatementPosition();
                $bankOperation->fill($item);
//                $bankOperation->date_open = $item->outdate;
//                $bankOperation->payer = $item->payerinfo;
//                $bankOperation->payer_inn = $item->payerinn;
//                $bankOperation->receiver = $item->recieverinfo;
//                $bankOperation->receiver_inn = $item->recieverinn;
//                $bankOperation->amount = $item->summ;
//                $bankOperation->description = $item->paydirection;
                $bankOperation->user_id = Auth::user()->id;
                $bankOperation->created_at = now();
                $bankOperation->save();
            }
        });
    }
}
