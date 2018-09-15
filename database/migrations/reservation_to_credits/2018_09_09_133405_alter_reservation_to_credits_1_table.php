<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterReservationToCredits1Table extends Migration
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
            $table->date('due_date')->nullable();
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
        Schema::table('reservation_to_credits', function(Blueprint $table)
        {
            $table->dropColumn('due_date');
            $table->softDeletes();

        });
    }
}
