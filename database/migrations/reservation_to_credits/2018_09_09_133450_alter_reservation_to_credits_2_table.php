<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterReservationToCredits2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_to_credits', function(Blueprint $table)
        {
            $table->string('amount')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation_to_credits', function(Blueprint $table)
        {
            $table->dropColumn('amount');

        });
    }
}
