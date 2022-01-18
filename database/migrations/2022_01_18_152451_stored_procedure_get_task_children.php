<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StoredProcedureGetTaskChildren extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS ps_task_children;
        ');

        $sql = <<<SQL
CREATE PROCEDURE ps_task_children(IN task_id int)
BEGIN
	call fetch_subtree_ids ('tasks', 'id', 'parent_task_id', task_id, 30, true, @a);
	SET @stm = CONCAT('select * from tasks where id in (',@a,')');
	PREPARE fetch_childs FROM @stm;
	        EXECUTE fetch_childs;
	        DROP PREPARE fetch_childs;
END;
SQL;

        DB::unprepared($sql);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS ps_task_children;
        ');
    }
}
