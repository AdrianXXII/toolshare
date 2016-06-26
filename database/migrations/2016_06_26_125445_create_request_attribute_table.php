<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_attribute', function (Blueprint $table) {
            $table->integer('request_id');
            $table->integer('attribute_id');

            $table->primary(['request_id', 'attribute_id']);
            $table->foreign('request_id')->references(id)->on('request');
            $table->foreign('attribute_id')->references(id)->on('attribute_val');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('request_attribute');
    }
}
