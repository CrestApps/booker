<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationToDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_to_drivers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('reservation_id')->unsigned()->nullable()->index();
            $table->integer('driver_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservation_to_drivers');
    }
}
