<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();;
            $table->string('description')->nullable();;
            $table->string('type')->nullable();;
            $table->string('etim_id')->nullable();
            $table->timestamps();
        });
        Schema::create('product_property_values', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('property_id')->unsigned();
            $table->bigInteger('value_id')->unsigned();
            $table->string('value')->unsigned();
            $table->unique(['product_id', 'property_id', 'value_id']);
        });
        Schema::create('property_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->bigInteger('property_id')->unsigned();
            $table->string('etim_id')->nullable();
        });

        Schema::table('product_property_values', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('property_values')->onDelete('cascade');

        });
        Schema::table('property_values', function (Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
        Schema::dropIfExists('product_property_values');
        Schema::dropIfExists('property_values');
    }
}
