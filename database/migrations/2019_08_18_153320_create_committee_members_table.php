<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admin_id')->nullable();
            $table->integer('committee_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('set null')->onDelete('cascade');
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
        Schema::dropIfExists('committee_members');
    }
}
