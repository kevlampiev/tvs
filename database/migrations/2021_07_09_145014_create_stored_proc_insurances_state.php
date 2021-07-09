<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoredProcInsurancesState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
$procedure = <<<SQL
CREATE PROCEDURE insurance_to_made_by_today(IN days_forward int)
BEGIN
SELECT v.name FROM vehicles v
LEFT JOIN (
SELECT vehicle_id, max(date_close) last_date FROM insurances GROUP BY vehicle_id HAVING last_date>DATE_ADD(CURRENT_DATE, INTERVAL days_forward DAY)
) alive_insurances ON v.id=alive_insurances.vehicle_id
WHERE alive_insurances.vehicle_id IS NULL;
END;
SQL;

        \Illuminate\Support\Facades\DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS insurance_to_made_by_today;
        ');
    }
}
