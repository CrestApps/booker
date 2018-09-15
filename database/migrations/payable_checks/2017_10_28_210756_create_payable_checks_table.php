<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayableChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payable_checks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('number')->unsigned()->nullable();
            $table->decimal('value', 10,3)->unsigned();
            $table->date('due_date');
            $table->date('issue_date');
            $table->integer('expense_id')->unsigned()->index();
            $table->boolean('is_cashed');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payable_checks');
    }
}
