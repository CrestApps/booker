<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterMaintenanceRecords2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenance_records', function(Blueprint $table)
        {
            $table->integer('category_id')->unsigned();
            $table->dropColumn('catgeory_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenance_records', function(Blueprint $table)
        {
            $table->dropColumn('category_id');
            $table->integer('catgeory_id')->unsigned();

        });
    }
}
