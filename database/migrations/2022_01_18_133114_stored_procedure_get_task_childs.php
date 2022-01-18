<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StoredProcedureGetTaskChilds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS fetch_subtree_ids;
        ');

        $sql = <<<SQL
CREATE PROCEDURE fetch_subtree_ids(
    IN name_table VARCHAR(64),
    IN name_id VARCHAR(64),
    IN name_parent VARCHAR(64),
    IN base INT UNSIGNED,
    IN max_levels INT,
    IN result_in_var BOOLEAN,
    OUT result_ids MEDIUMTEXT
)
BEGIN
    DECLARE ids MEDIUMTEXT DEFAULT '';
    DECLARE currlevel INT DEFAULT 0;

    SET @parents = base;

    IF result_in_var THEN
        SET result_ids = '';
    END IF;

    -- В случае если max_levels равно 0, то допускаем 100000 уровней.
    -- Отрицательные значения дадут один уровень — это побочное явление.
    SET currlevel = IF(max_levels, 1, -100000);

    REPEAT
        -- Внимание! Значение base тоже входит в результат.
        IF result_in_var THEN
            -- Если result_in_var истинно, то результат сохраняем в result_ids.
            SET result_ids = CONCAT(result_ids, IF(LENGTH(result_ids), ',', ''), @parents);
        ELSE
            -- Иначе сохраняем в локальной переменной.
            SET ids = CONCAT(ids, IF(LENGTH(ids), ',', ''), @parents);
        END IF;

        SET @stm = CONCAT(
            'SELECT GROUP_CONCAT(', name_id, ') INTO @parents FROM ', name_table,
            ' WHERE ', name_parent, ' IN (', @parents, ')'
        );

        PREPARE fetch_childs FROM @stm;
        EXECUTE fetch_childs;
        DROP PREPARE fetch_childs;

        SET currlevel = currlevel + 1;
    UNTIL (@parents IS NULL OR currlevel > max_levels) END REPEAT;

    IF NOT result_in_var THEN
        -- Если результат не в переменной — вернем рекордсет.
        SET @stm := CONCAT(
            'SELECT ', name_id, ' FROM ', name_table,
            ' WHERE ', name_id, ' IN (', ids, ')'
        );

        PREPARE fetch_childs FROM @stm;
        EXECUTE fetch_childs;
        DROP PREPARE fetch_childs;
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
                    DROP PROCEDURE IF EXISTS fetch_subtree_ids;
        ');
    }
}
