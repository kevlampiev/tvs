<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AggrSettltmentReportProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::statement('
//            DELIMITER //
//            CREATE PROCEDURE settlements_by_date(selection_date date)
//            BEGIN
//            select una.company, una.counterparty, sum(una.must_pay) must_pay_sum, sum(una.payed) payed_sum
//            FROM
//            (
//            select c.name company,
//                    cp.name counterparty,
//                    sum(p.amount) must_pay,
//                    0 payed
//            from agreement_payments p
//            inner join agreements a on a.id=p.agreement_id
//            inner join companies c on c.id=a.company_id
//            inner join counterparties cp on cp.id=a.counterparty_id
//            where (p.payment_date<= selection_date )
//            group by company, counterparty, payed
//            UNION
//            select c.name company,
//                    cp.name counterparty,
//                    0 must_pay,
//                    sum(p.amount) payed
//            from real_payments p
//            inner join agreements a on a.id=p.agreement_id
//            inner join companies c on c.id=a.company_id
//            inner join counterparties cp on cp.id=a.counterparty_id
//            where (p.payment_date<= selection_date)
//            group by company, counterparty, must_pay
//            ) una
//            GROUP BY una.company, una.counterparty;
//
//            END //
//
//            DELIMITER ;
//    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//      DB::statement(
//          'DROP PROCEDURE IF EXISTS settlements_by_date;'
//      );
    }
}
