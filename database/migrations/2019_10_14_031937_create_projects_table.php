<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('description');
            $table->date('date_release');
            $table->boolean('confirm')->default(false);
            $table->boolean('realise')->default(false);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
        Schema::create('product_project', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->integer('count');
            $table->timestamps();
            $table->unique(['product_id', 'project_id']);
        });

        Schema::table('product_project', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('product_project');
    }
}
