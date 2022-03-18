<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GreatSearchView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Создаем view с максимально полной информацией об объектах


    $sql = <<<SQL
CREATE view v_all_entities_searching_view AS
select a.id,
	'agreement' entity_type,
	CONCAT(IFNULL(a.name,' '), ' ', IFNULL(a.agr_number, ' '),' ', IFNULL( a.description, ' '), c.name, ' ', cp.name, ' ', at2.name) entity_text,
	a.date_close closed_at
from agreements a
LEFT JOIN companies c ON a.company_id = c.id
LEFT JOIN counterparties cp ON a.counterparty_id = cp.id
LEFT JOIN agreement_types at2 ON at2.id= a.agreement_type_id
UNION
select v.id,
	'vehicle' entity_type ,
	CONCAT(IFNULL(v.name, '') , IFNULL(v.vin, ''), ' ', IFNULL(v.bort_number,''), ' ', m.name ,' ', vt.name  ) entity_text ,
	v.sale_date  closed_at
from vehicles v
LEFT JOIN vehicle_types vt ON vt.id=v.vehicle_type_id
LEFT JOIN manufacturers m ON m.id = v.manufacturer_id
UNION
select t.id,
		'task' entity_type ,
		CONCAT(IFNULL( t.subject,''),' ', IFNULL(t.description,'')) entity_text,
		t.terminate_date closed_at
from tasks t
UNION
select m.id,
		'message' entity_type ,
		CONCAT(IFNULL( m.subject,''), ' ', IFNULL(m.description,'')) entity_text,
		null closed_at
from messages m
UNION
SELECT vn.id,
	'vehicle_none' entity_type,
	vn.note_body entity_text ,
	null closed_at
FROM vehicle_notes vn
UNION
SELECT an.id,
	'agreement_none' entity_type,
	an.note_body entity_text ,
	null closed_at
FROM agreement_notes an  ;
SQL;

        //Заменяем процедуру, тут тоже вылезают неправильные страховки
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW v_all_entities_searching_view ');
    }
}
