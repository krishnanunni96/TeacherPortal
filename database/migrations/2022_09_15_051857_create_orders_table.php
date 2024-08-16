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
            $table->foreignId('customer_id')->constrained();
            $table->string('order_no')->unique();
            $table->date('date_of_order');
            $table->date('date_of_delivery');
            $table->decimal('order_amount',10,2);
            $table->decimal('sub_total',12,2);
            $table->decimal('tax_amount',12,2);
            $table->decimal('paid_amount',12,2);
            $table->integer('payment_type');
            $table->decimal('discount',8,2);
            $table->longText('remark')->nullable();
            $table->decimal('balance',12,2);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('orders');
    }
}
