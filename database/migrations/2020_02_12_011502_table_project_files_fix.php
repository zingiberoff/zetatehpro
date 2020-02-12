<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProjectFilesFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('project_files', function (Blueprint $table) {
            $table->dropForeign('project_files_project_id_foreign');
        });
        Schema::table('project_files', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });
        Schema::create('project_project_file', function (Blueprint $table) {
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('project_file_id')->unsigned();
        });
        Schema::table('project_project_file', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('project_file_id')->references('id')->on('project_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('project_files', function (Blueprint $table) {
            $table->bigInteger('project_id')->unsigned()->nullable();
        });
        Schema::table('project_files', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
        Schema::dropIfExists('project_project_file');
    }
}
