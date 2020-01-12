<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->string('action_name');
            $table->string('description');
            $table->json('next_statuses');
            $table->timestamps();
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('project_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('payment_type');
            $table->string('description');
            $table->timestamps();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->bigInteger('status');
            $table->string('status_confirmation');
    });
        Schema::table('product_project',function (Blueprint $table){
            $table->boolean('confirm');
            $table->boolean('realize');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('project_statuses');
        Schema::table('product_project',function (Blueprint $table){
            $table->dropColumn('confirm');
            $table->dropColumn('realize');
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('status_confirmation');
        });
    }
}
