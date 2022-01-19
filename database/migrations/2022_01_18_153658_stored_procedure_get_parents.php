<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StoredProcedureGetParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS fetch_parent_ids;
        ');

        $sql = <<<SQL
CREATE PROCEDURE fetch_parent_ids(
    IN name_table VARCHAR(64),
    IN name_id VARCHAR(64),
    IN name_parent VARCHAR(64),
    IN base INT UNSIGNED,
    IN max_levels INT,
    IN result_in_var BOOLEAN,
    OUT result_ids MEDIUMTEXT
)
BEGIN
    DECLARE currlevel INT;
    DECLARE ids MEDIUMTEXT DEFAULT '';

    IF result_in_var THEN
        SET result_ids = '';
    END IF;

    SET @parent = base;

    -- В случае если max_levels равно 0, то допускаем 100000 уровней.
    -- Отрицательные значения дадут один уровень — это побочное явление.
    SET currlevel = IF(max_levels, 1, -100000);

    SET @stm = CONCAT(
        'SELECT ', name_parent, ' INTO @parent FROM ', name_table, ' WHERE ', name_id, ' = ?'
    );
    PREPARE fetch_parent FROM @stm;

    REPEAT
        EXECUTE fetch_parent USING @parent;

        IF result_in_var THEN
            -- Если result_in_var истинно, то результат сохраняем в result_ids.
            SET result_ids = CONCAT(result_ids, IF(LENGTH(result_ids), ',', ''), @parent);
        ELSE
            -- Иначе сохраняем в локальной переменной.
            SET ids = CONCAT(ids, IF(LENGTH(ids), ',', ''), @parent);
        END IF;

        SET currlevel = currlevel + 1;
    UNTIL (NOT @parent OR currlevel > max_levels) END REPEAT;

    DROP PREPARE fetch_parent;

    IF NOT result_in_var THEN
        -- Если результат не в переменной — вернем рекордсет.
        SET @stm = CONCAT(
            'SELECT ', name_id, ' FROM ', name_table,
            ' WHERE ', name_id, ' IN (', ids, ')'
        );

        PREPARE fetch_parents FROM @stm;
        EXECUTE fetch_parents;
        DROP PREPARE fetch_parents;
    END IF;
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
                    DROP PROCEDURE IF EXISTS fetch_parent_ids;
        ');
    }
}
