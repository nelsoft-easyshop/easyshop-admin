<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsOrderProduct extends Migration 
{

   /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('es_order_product', function(Blueprint $table)
        {
            $table->increments('id_order_product');
            $table->integer('order_id');
            $table->integer('seller_id');
            $table->integer('product_id');
            $table->integer('order_quantity');
            $table->decimal('price', 15, 4);
            $table->decimal('handling_fee', 15, 4);
            $table->decimal('total', 15, 4);
            $table->integer('status');
            $table->integer('buyer_billing_id');
            $table->tinyInteger('is_reject');
            $table->decimal('easyshop_charge', 15, 4);
            $table->decimal('payment_method_charge', 15, 4);
            $table->decimal('net', 15, 4);
            $table->integer('seller_billing_id');			
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
        Schema::drop('es_order_product');
    }

}
