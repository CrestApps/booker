<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function(Blueprint $table)
        {
            $table->timestamps();
            $table->softDeletes();
            $table->string('defaultvaluettt');
            $table->string('description', 1000);
            $table->string('datavaluettt');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('texts');
    }
}
