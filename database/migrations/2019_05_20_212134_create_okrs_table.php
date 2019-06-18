<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOkrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('okrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('OKRs_title');
            $table->text('description')->nullable();
            $table->integer('created_by')->unsigned();
            $table->string('status')->default('Proposed');
            $table->string('categories')->nullable();
            $table->string('impact_groups')->nullable();
            $table->string('contributors')->nullable();
            $table->string('target_date')->nullable();
            $table->string('vx_impact')->nullable();
            $table->string('completion_date')->nullable();

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
        Schema::dropIfExists('okrs');
    }
}
