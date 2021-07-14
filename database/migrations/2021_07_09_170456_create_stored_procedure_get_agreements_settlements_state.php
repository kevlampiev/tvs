<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredProcedureGetAgreementsSettlementsState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
$sql=<<<SQL
CREATE PROCEDURE get_agreement_settlements_by_today(IN days_forward int)
BEGIN
select company, counterparty, id, agreement_name, agr_number, agreement_date, sum(must_be_payed-payed) overdue, sum(upcoming_payments) upcoming
from (
    select c.name as company,
	   cp.name as counterparty,
       a.name as agreement_name,
       a.id,
       a.agr_number,
       a.date_open as agreement_date,
       sum(ap.amount) as must_be_payed,
       0 as payed,
       0 as upcoming_payments
from agreements a
inner join companies c on c.id=a.company_id
inner join counterparties cp on cp.id=a.counterparty_id
inner join agreement_payments ap on ap.agreement_id = a.id and ap.payment_date<current_date()
group by c.name, cp.name, a.id, a.name, a.agr_number, a.date_open
UNION
select c.name as company,
	   cp.name as counterparty,
       a.id,
       a.name as agreement_name,
       a.agr_number,
       a.date_open as agreement_date,
       0 as must_be_payed,
       sum(rp.amount) as payed,
       0 as upcoming_payments
from agreements a
inner join companies c on c.id=a.company_id
inner join counterparties cp on cp.id=a.counterparty_id
inner join real_payments rp on rp.agreement_id = a.id and rp.payment_date<current_date()
group by c.name, cp.name, a.id, a.name, a.agr_number, a.date_open
UNION
select c.name as company,
	   cp.name as counterparty,
       a.id,
       a.name as agreement_name,
       a.agr_number,
       a.date_open as agreement_date,
       0 as must_be_payed,
       0 as payed,
       sum(ap.amount) as upcoming_payments
from agreements a
inner join companies c on c.id=a.company_id
inner join counterparties cp on cp.id=a.counterparty_id
inner join agreement_payments ap on ap.agreement_id = a.id and (ap.payment_date BETWEEN current_date() AND DATE_ADD(current_date(), INTERVAL days_forward DAY))
group by c.name, cp.name, a.id, a.name, a.agr_number, a.date_open
) as gross_view
GROUP BY company, counterparty, id, agreement_name, agr_number, agreement_date;
END;
SQL;

        \Illuminate\Support\Facades\DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
                    DROP PROCEDURE IF EXISTS get_agreement_settlements_by_today;
        ');
    }
}
