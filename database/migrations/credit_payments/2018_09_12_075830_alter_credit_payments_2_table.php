<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterCreditPayments2Table extends Migration
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
            $table->string('payment_method')->nullable();
            $table->integer('check_id')->unsigned()->nullable()->index();
            $table->dropColumn('deleted_at');

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
            $table->dropColumn('payment_method');
            $table->dropColumn('check_id');
            $table->softDeletes();

        });
    }
}
