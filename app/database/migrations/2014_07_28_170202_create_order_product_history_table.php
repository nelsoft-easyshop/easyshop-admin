<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductHistoryTable extends Migration 
{

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('es_order_product_history', function(Blueprint $table)
        {
            $table->increments('id_order_product_history');
            $table->integer('order_product_id');
            $table->string('comment',255);
            $table->timestamps();
            $table->integer('order_product_status');
        });
    }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('es_order_product_history');
    }

}
