<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name', 255)->nullable();
            $table->integer('size_id')->unsigned()->index();
            $table->integer('brand_id')->unsigned()->index();
            $table->string('model', 255)->nullable();
            $table->smallInteger('year')->nullable();
            $table->string('color')->nullable();
            $table->dateTime('last_oil_change');
            $table->integer('miles_to_oil_change')->nullable();
            $table->integer('current_miles')->nullable();
            $table->dateTime('registration_experation_on');
            $table->dateTime('insurance_experation_on');
            $table->decimal('daily_rate', 10,3)->unsigned();
            $table->decimal('weekly_rate', 10,3)->unsigned();
            $table->decimal('monthly_rate', 10,3)->unsigned();
            $table->boolean('is_active');
            $table->string('vin_number', 60);
            $table->string('licence_plate', 30);
            $table->decimal('purchase_cost', 10,3)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vehicles');
    }
}
