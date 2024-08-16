<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_id');
            $table->string('product_name');
            $table->decimal('rate',8,2);
            $table->integer('quantity');
            $table->integer('tax_percentage');
            $table->decimal('tax_amount',8,2);
            $table->decimal('total',8,2);
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
        Schema::dropIfExists('product__purchases');
    }
}
