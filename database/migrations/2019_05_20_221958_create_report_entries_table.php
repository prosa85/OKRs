<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text');
            $table->string('type');
            $table->integer('created');
            $table->integer('user_id')->unsigned();
            $table->integer('report_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_entries');
    }
}
