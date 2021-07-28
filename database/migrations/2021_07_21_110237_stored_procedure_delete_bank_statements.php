<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoredProcedureDeleteBankStatements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql=<<<SQL
CREATE PROCEDURE delete_bank_statements (IN a_user_id int)
BEGIN
    DELETE FROM bank_statement_positions WHERE user_id = a_user_id;
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
        \Illuminate\Support\Facades\DB::statement('DROP PROCEDURE delete_bank_statements;');
    }
}
