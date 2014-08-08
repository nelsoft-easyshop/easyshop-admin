<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductBillingInfoTable extends Migration 
{

   /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('es_order_product_billing_info', function(Blueprint $table)
        {
            $table->increments('id_order_billing_info');
            $table->string('bank_name', 255);
            $table->string('account_name', 255);
            $table->string('account_number', 255);
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
        Schema::drop('es_order_billing_info');
    }

}
