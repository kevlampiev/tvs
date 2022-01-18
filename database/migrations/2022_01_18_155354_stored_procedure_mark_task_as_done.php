<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoredProcedureMarkTaskAsDone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS po_mark_task_as_done;
        ');

        $sql = <<<SQL
CREATE PROCEDURE po_mark_task_as_done(IN task_id int)
BEGIN
	call fetch_subtree_ids ('tasks', 'id', 'parent_task_id', task_id, 30, true, @a);
	SET @stm = CONCAT('update tasks set terminate_status="complete", terminate_date=CURRENT_DATE() where id in (',@a,')');
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
                    DROP PROCEDURE IF EXISTS po_mark_task_as_done;
        ');
    }
}
