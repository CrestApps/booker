<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function(Blueprint $table)
        {
            $table->timestamps();
            $table->softDeletes();
            $table->string('name', 255);
            $table->string('description', 1000);
            $table->boolean('is_admin');
            $table->index(['is_admin','created_at'], 'someTest');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tests');
    }
}
