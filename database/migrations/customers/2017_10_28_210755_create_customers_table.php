<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('fullname', 255);
            $table->string('home_address', 500)->nullable();
            $table->string('personal_identification_number', 30);
            $table->string('driver_license_number', 30)->index();
            $table->date('birth_date');
            $table->date('driver_license_issue_date');
            $table->date('driver_license_experation_date');
            $table->string('phone', 30);
            $table->boolean('is_black_listed');
            $table->string('black_list_notes', 1000)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
