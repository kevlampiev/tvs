<?php


namespace App\DataServices\Admin;


use App\Models\Agreement;
use App\Models\BankStatementPosition;
use App\Models\Company;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Statement;

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
                $item['date_open']= DateTime::createFromFormat('d.m.Y',$item['date_open']);
                $bankOperation->fill($item);
                $bankOperation->user_id = Auth::user()->id;
                $bankOperation->created_at = now();
                $bankOperation->save();
            }
        });
        $ds = collect(DB::select('SELECT bs.id bsid, a.id agreement_id
            FROM bank_statement_positions bs
            INNER JOIN agreements a ON bs.description LIKE CONCAT(\'%\',a.agr_number,\'%\')
            WHERE bs.agreement_id is null and bs.user_id = ?', [Auth::user()->id]));
        foreach ($ds as $el) {
            $dsRecord = BankStatementPosition::find($el->bsid);
            $dsRecord->agreement_id = $el->agreement_id;
            $dsRecord->save();
        }

    }

    /**
     * Перенос данных из промежуточной таблицы в real_payments
     *return void
     */
    public static function transferToRealPayments()
    {
        DB::statement('
            INSERT INTO real_payments(agreement_id, payment_date, amount, currency, description)
            SELECT a.id, bs.date_open, bs.amount, \'RUR\', bs.description
            FROM bank_statement_positions bs
            INNER JOIN agreements a ON bs.description LIKE CONCAT(\'%\',a.agr_number,\'%\')
            WHERE bs.user_id = ?', [Auth::user()->id]);

        DB::statement('DELETE FROM bank_statement_positions WHERE user_id=?',[Auth::user()->id]);
    }

    /**
     * Снабжает данными представление для привязки договора к платежу из выписки 1С
     */
    public static function provideAddAgreementView(BankStatementPosition $bankStatementPosition):array
    {
        $agreements = Agreement::all();
        return [
            'agreements'=>$agreements,
            'bankStatementPosition' => $bankStatementPosition,
        ];
    }

}
