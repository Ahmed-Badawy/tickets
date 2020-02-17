<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('col')->nullable();
            $table->string('olddata')->nullable();
            $table->string('newdata')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('content')->nullable();
            $table->string('file')->nullable();
            $table->enum('type',['supplier','admin'])->default('supplier');
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
        Schema::dropIfExists('logs');
    }
}
