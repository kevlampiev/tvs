<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ALterViewvInsurancesMostDistantDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Заменяем view который лежит в основе хранимаой процедуры выдачи страховок с истекающим сроком действия. Удаляем
        //проданные или вышедшие из строя авто
        DB::unprepared('CREATE OR REPLACE VIEW v_insurances_most_distant_dates AS
                        select i.vehicle_id, v.name vehicle, it.name insurance_type, max(i.date_close) last_date
                        from insurances i INNER JOIN vehicles v ON i.vehicle_id = v.id
                        INNER JOIN insurance_types it ON i.insurance_type_id=it.id
                        WHERE v.sale_date>current_date() OR v.sale_date IS NULL
                        GROUP BY 1, 2, 3;');

        //Заменяем процедуру, тут тоже вылезают неправильные страховки
        DB::unprepared('DROP PROCEDURE ps_insurances_to_renewal;');
        $sql = <<<SQL
CREATE PROCEDURE ps_insurances_to_renewal (IN forcast INT)
BEGIN
	select * from v_insurances_most_actual where datediff(date_close, current_date())<forcast
	UNION
	select id, name, null, null, null,null from vehicles
    where id not in (select distinct vehicle_id from insurances)
		 and ((sale_date>current_date()) or (sale_date is null));
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
        //Делаем как было без конструкции WHERE
        DB::unprepared('CREATE OR REPLACE VIEW v_insurances_most_distant_dates AS
                        select i.vehicle_id, v.name vehicle, it.name insurance_type, max(i.date_close) last_date
                        from insurances i INNER JOIN vehicles v ON i.vehicle_id = v.id
                        INNER JOIN insurance_types it ON i.insurance_type_id=it.id
                        GROUP BY 1, 2, 3;');
        DB::unprepared('DROP PROCEDURE ps_insurances_to_renewal;');
        $sql = <<<SQL
CREATE PROCEDURE ps_insurances_to_renewal (IN forcast INT)
BEGIN
	select * from v_insurances_most_actual where datediff(date_close, current_date())<forcast
	UNION
	select id, name, null, null, null,null from vehicles
    where id not in (select distinct vehicle_id from insurances);
END;
SQL;

        DB::unprepared($sql);
    }
}
