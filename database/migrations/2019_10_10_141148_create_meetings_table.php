<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic');
            $table->unsignedInteger('committee_id');
            $table->timestamp('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status',['pending','in-progress','completed'])->default('pending');
            $table->text('description')->default('');
            $table->text('description_header')->default('');
            $table->foreign('committee_id')->references('id')->on('committees')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('meetings');
    }
}
