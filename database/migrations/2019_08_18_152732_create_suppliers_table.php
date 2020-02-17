<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->unique();
            $table->string('commercial_name')->nullable();
            $table->string('username')->unique();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('website')->nullable();
            $table->tinyInteger('blocked')->default(0);
            $table->bigInteger('capital_of_enterprise')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->date('status_at')->nullable();
            $table->tinyInteger('national')->default(0);
            $table->tinyInteger('invited')->default(0);
            $table->string('image')->nullable();
            $table->string('corporate_email')->nullable();
            $table->string('business_type')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('reg_code')->nullable();
            $table->string('for_company')->nullable();
            $table->string('email_confirmation')->nullable();
            $table->string('lang')->default('en');
            $table->date('confirmed_at')->nullable();
            $table->integer('rejections')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
