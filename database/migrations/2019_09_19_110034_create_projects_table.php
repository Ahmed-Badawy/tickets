<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('supplier_id');
            $table->string('name');
            $table->string('location');
            $table->string('phone')->nullable();
            $table->string('project_title');
            $table->string('project_purpos');
            $table->string('scope');
            $table->string('part')->nullable();
            $table->string('file')->nullable();
            $table->integer('activity_id');
            $table->double('awarded_value');
            $table->double('contract_value');
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
        Schema::dropIfExists('projects');
    }
}
