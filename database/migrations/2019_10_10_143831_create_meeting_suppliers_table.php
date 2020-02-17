<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->nullable();
            $table->integer('meeting_id');
            $table->integer('committee_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('set null')->onDelete('cascade');
            $table->foreign('committee_id')->references('id')->on('committees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('meeting_id')->references('id')->on('meetings')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('meeting_suppliers');
    }
}
