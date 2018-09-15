<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterCreditPayments1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_payments', function(Blueprint $table)
        {
            $table->decimal('amount', 10,3);
            $table->dropColumn('paid_at');
            $table->dropColumn('paid_amount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_payments', function(Blueprint $table)
        {
            $table->dropColumn('amount');
            $table->dateTime('paid_at');
            $table->decimal('paid_amount', 10,3);

        });
    }
}
