<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('primary_driver_id')->unsigned()->index();
            $table->integer('vehicle_id')->unsigned()->index();
            $table->dateTime('reserved_from');
            $table->dateTime('reserved_to');
            $table->dateTime('picked_up_at')->nullable();
            $table->dateTime('dropped_off_at')->nullable();
            $table->integer('total_days');
            $table->decimal('total_override', 10,3)->nullable();
            $table->decimal('total_rent', 10,3);
            $table->string('total_tax', 10)->nullable();
            $table->decimal('total_paid_in_cash', 10,3)->nullable();
            $table->decimal('total_paid_in_bank_card', 10,3)->nullable();
            $table->decimal('total_owe', 10,3)->nullable();
            $table->integer('mileage_started_at')->nullable();
            $table->integer('mileage_ends_at')->nullable();
            $table->enum('status', ['scheduled','cancelled','completed'])->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservations');
    }
}
