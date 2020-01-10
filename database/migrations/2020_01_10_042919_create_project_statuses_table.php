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
            $table->string('description');
            $table->timestamps();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->bigInteger('status');
            $table->string('status_confirmation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_statuses');
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('status_confirmation');
        });
    }
}
