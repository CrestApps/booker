<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaintenanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_records', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('vehicle_id')->unsigned();
            $table->integer('catgeory_id')->unsigned();
            $table->double('cost', 10,3)->nullable();
            $table->dateTime('paid_at');
            $table->date('related_date');
            $table->string('notes', 1000)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maintenance_records');
    }
}
