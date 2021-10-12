<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewAllVehiclesWithInsurances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_all_vehicles_with_insurances');
        DB::unprepared('CREATE view v_all_vehicles_with_insurances AS
select vehicle_id,
	vehicle,
	max(insurance_company) insurance_company,
	insurance_type,
	max(date_open) date_open,
	max(date_close) date_close
from (
select * from v_insurances_most_actual ai
UNION
select v.id vehicle_id ,
	v.name vehicle ,
	null insurance_company ,
	it.name insurance_type ,
	null date_open,
	null date_close
from vehicles v, insurance_types it
) st
group by insurance_type, vehicle_id,vehicle');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_all_vehicles_with_insurances');
    }
}
