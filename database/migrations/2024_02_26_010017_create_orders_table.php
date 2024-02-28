<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('gateway_code',255)->nullable();
            $table->string('customer_id',255);
            $table->text('line_items')->nullable();
            $table->string('amout',255)->nullable();
            $table->string('status');
            $table->string('payment_status',255);
            $table->string('payment_method',255)->nullable();
            $table->text('payment_details')->nullable();
            $table->string('checkout_status',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
