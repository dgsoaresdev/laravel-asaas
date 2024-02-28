<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('gateway_code',255)->nullable();
            $table->string('order_id',255);
            $table->string('customer_id',255);
            $table->string('amout',255)->nullable();
            $table->string('status');
            $table->string('payment_status',255);
            $table->string('payment_method',255)->nullable();
            $table->text('payment_details')->nullable();
            $table->text('payment_doc')->nullable();
            $table->string('payment_auth',255)->nullable();
            $table->dateTime('date_time', $precision = 0)->nullable();
            $table->date('date_due')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
