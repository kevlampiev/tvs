<?php


namespace App\DataServices\Admin;


use App\Models\Agreement;
use App\Models\BankStatementPosition;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BankStatementDataservice
{
    public static function provideData(): array
    {
//        $data = collect(DB::select('SELECT bs.*, a.agr_number, a.date_open agr_date
//                    FROM bank_statement_positions bs
//                    LEFT JOIN agreements a ON bs.agreement_id=a.id
//                    WHERE bs.user_id=?
//                    ', [Auth::user()->id]));
        $data = BankStatementPosition::all();
        return ['bankStatementPositions' => $data];
    }

    /**
     * Функция закачки данных о совершенных банковских операциях в промежуточную таблицу
     *return void
     */
    public static function storeData(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                $bankOperation = new BankStatementPosition();
                $item['date_open'] = DateTime::createFromFormat('d.m.Y', $item['date_open']);
                $bankOperation->fill($item);
                $bankOperation->user_id = Auth::user()->id;
                $bankOperation->created_at = now();
                $bankOperation->save();
            }
        });
        DB::statement('CALL prepare_bank_statements(?)', [Auth::user()->id]);

    }

    /**
     * Перенос данных из промежуточной таблицы в real_payments
     *return void
     */
    public static function transferToRealPayments()
    {
        DB::statement('CALL transfer_bank_statements(?)', [Auth::user()->id]);
    }

    /**
     * Снабжает данными представление для привязки договора к платежу из выписки 1С
     */
    public static function provideAddAgreementView(BankStatementPosition $bankStatementPosition): array
    {
        $agreements = Agreement::all();
        return [
            'agreements' => $agreements,
            'bankStatementPosition' => $bankStatementPosition,
        ];
    }

    public static function deleteBankStatements()
    {
        DB::statement('CALL delete_bank_statements(?)', [Auth::user()->id]);
    }

}
