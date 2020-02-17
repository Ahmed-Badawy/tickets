<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id');
            $table->integer('activity_id');
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('product')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_category')->default(0);
            $table->text('reason')->nullable();
            $table->text('other')->nullable();
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
        Schema::dropIfExists('supplier_activities');
    }
}
