<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoredProcPaymentsState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
$procedure = <<<SQL
CREATE PROCEDURE settlements_by_date(IN days_forward int)
BEGIN
SELECT company, GREATEST(sum(must_be_payed-payed),0) overdue, sum(upcoming) upcoming
FROM (
SELECT c.code company, sum(p.amount) must_be_payed, 0 payed, 0 upcoming
FROM companies c
INNER JOIN agreements a ON a.company_id = c.id
INNER JOIN agreement_payments p ON p.agreement_id=a.id and p.payment_date<current_date()
GROUP BY c.code
UNION
SELECT c.code company, 0 must_be_payed, sum(p.amount) payed, 0 upcoming
FROM companies c
INNER JOIN agreements a ON a.company_id = c.id
INNER JOIN real_payments p ON p.agreement_id=a.id and p.payment_date<current_date()
GROUP BY c.code
UNION
SELECT c.code company, 0 must_be_payed, 0 payed, sum(p.amount) upcoming
FROM companies c
INNER JOIN agreements a ON a.company_id = c.id
INNER JOIN agreement_payments p ON p.agreement_id=a.id and (p.payment_date BETWEEN current_date() AND DATE_ADD(current_date(), INTERVAL days_forward DAY))
GROUP BY c.code
) as gross_p
GROUP BY company;
END;
SQL ;
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
                    DROP PROCEDURE IF EXISTS settlements_by_date;
        ');
    }
}
