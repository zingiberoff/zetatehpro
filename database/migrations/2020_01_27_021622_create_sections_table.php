<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable()->unsigned();;
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('path')->nullable();
            $table->unsignedInteger('_lft')->nullable();;
            $table->unsignedInteger('_rgt')->nullable();;
            $table->timestamps();
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('sections')->onDelete('cascade');
        });
        Schema::create('product_section', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();;
        });
        Schema::table('product_section', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->unique(['section_id', 'product_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
        Schema::dropIfExists('product_section');

    }
}
