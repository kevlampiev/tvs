<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoredProcedureInsurancesToRenewal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS pg_insurances_to_renewal;
        ');

        $sql = <<<SQL
CREATE PROCEDURE pg_insurances_to_renewal(IN  days_forward int)
BEGIN
select v.name vehicle,
	v.vin,
    it.name insurance_type,
    ic.name ic_name,
    i.date_open,
    i.date_close
    from vehicles v
    LEFT JOIN insurances i ON i.vehicle_id=v.id AND i.date_close<DATE_ADD(CURRENT_DATE, INTERVAL days_forward DAY)
    LEFT JOIN insurance_types it ON it.id=i.insurance_type_id
    LEFT JOIN insurance_companies ic ON i.insurance_company_id=ic.id;
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
                    DROP PROCEDURE IF EXISTS pg_insurances_to_renewal;
        ');
    }
}
