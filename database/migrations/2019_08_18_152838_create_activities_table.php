<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('parent_id');
            $table->string('name');
            $table->string('code')->unique();
            $table->integer('role_id')->nullable();
            $table->tinyInteger('product')->default(0);
            $table->tinyInteger('show')->default(1);
            $table->enum('type',['Service Provider','vendor','bidder'])->default('Service Provider');
            $table->foreign('parent_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('activities');
    }
}
