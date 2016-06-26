<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_vals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->integer('attribute_def_id');
            $table->foreign('attribute_def_id')->references('id')->on('attribute_def');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attribute_vals');
    }
}
