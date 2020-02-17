<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('country_id')->nullable();
            $table->string('city_id')->nullable();
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
        Schema::dropIfExists('supplier_branches');
    }
}
