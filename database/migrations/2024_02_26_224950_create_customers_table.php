<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('gateway_code',255)->nullable();
            $table->string('name',255);
            $table->string('surname',255);
            $table->string('email',255);
            $table->string('cpfCnpj',255);
            $table->string('telefone',255)->nullable();
            $table->string('mobilePhone',255);
            $table->string('address',255)->nullable();
            $table->string('addressNumber',255)->nullable();
            $table->string('complement',255)->nullable();
            $table->string('province',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('postalCode',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
