<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('email_template_id');
            $table->unsignedInteger('doc_id');
            $table->timestamps();
            $table->foreign('email_template_id')->references('id')->on('email_templates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('doc_id')->references('id')->on('system_documents')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_docs');
    }
}
