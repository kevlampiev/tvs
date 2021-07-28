<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoredProcedurePrepareBankStatements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql=<<<SQL
CREATE PROCEDURE prepare_bank_statements (IN user_id int)
BEGIN
	DECLARE bs_id, agr_id INT;
    DECLARE done INT DEFAULT 0;
    DECLARE curs CURSOR FOR SELECT bs.id bsid, a.id agreement_id FROM bank_statement_positions bs INNER JOIN agreements a ON bs.description LIKE CONCAT("%",a.agr_number,"%") WHERE bs.agreement_id is null and bs.user_id = user_id;
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

	OPEN curs;
	START TRANSACTION;
		REPEAT
			FETCH curs INTO bs_id, agr_id;
			UPDATE bank_statement_positions SET agreement_id=agr_id WHERE id=bs_id;
		UNTIL done END REPEAT;
    COMMIT;
    CLOSE curs;
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
        \Illuminate\Support\Facades\DB::statement('DROP PROCEDURE prepare_bank_statements;');
    }
}
