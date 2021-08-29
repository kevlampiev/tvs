<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReplaceProcedureInsurancesToRenewal extends Migration
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

        DB::unprepared('
        CREATE VIEW v_insurances_most_distant_dates as
select i.vehicle_id, v.name vehicle, it.name insurance_type, max(i.date_close) last_date
from insurances i INNER JOIN vehicles v ON i.vehicle_id = v.id
INNER JOIN insurance_types it ON i.insurance_type_id=it.id
GROUP BY 1, 2, 3;
        ');

        DB::unprepared('CREATE VIEW v_insurances_most_actual AS
SELECT i.vehicle_id,
		li.vehicle,
        ic.name insurance_company,
        li.insurance_type,
        i.date_open,
        i.date_close
FROM insurances i INNER JOIN v_insurances_most_distant_dates li ON i.vehicle_id=li.vehicle_id AND i.date_close=li.last_date
INNER JOIN insurance_companies ic ON i.insurance_company_id=ic.id;');

        $sql = <<<SQL
CREATE PROCEDURE ps_insurances_to_renewal (IN forcast INT)
BEGIN
	select * from v_insurances_most_actual where datediff(date_close, current_date())<forcast
	UNION
	select id, name, null, null, null,null from vehicles where id not in (select distinct vehicle_id from insurances);
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
}
