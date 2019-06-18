<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('OKR_id')->unsigned();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status',['Proposed', 'Active','Hold', 'Completed'])->default("Proposed");
            $table->string('target_date')->nullable();
            $table->string('completion_date')->nullable();
            $table->string('vx_impact')->nullable();
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
        Schema::dropIfExists('krs');
    }
}
