<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoredProcedureTransferBankStatements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql=<<<SQL
CREATE PROCEDURE transfer_bank_statements (IN a_user_id int)
BEGIN
    START TRANSACTION;
	 INSERT INTO real_payments(agreement_id, payment_date, amount, currency, description)
            SELECT bs.agreement_id, bs.date_open, bs.amount, 'RUR', bs.description
            FROM bank_statement_positions bs
            WHERE bs.user_id = a_user_id AND bs.agreement_id IS NOT NULL;
     DELETE FROM bank_statement_positions WHERE user_id= a_user_id;
     COMMIT;
END;
SQL;

        \Illuminate\Support\Facades\DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('DROP PROCEDURE transfer_bank_statements;');
    }
}
