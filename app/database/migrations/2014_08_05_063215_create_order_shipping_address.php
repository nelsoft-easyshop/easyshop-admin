<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderShippingAddress extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es_order_shipping_address', function(Blueprint $table)
        {
            $table->increments('id_order_shipping_address');
            $table->integer('stateregion');
            $table->integer('city');
            $table->integer('country');
            $table->string('address', 250);
            $table->string('consignee', 45)->nullable()->default('');
            $table->string('mobile', 45)->nullable()->default('');
            $table->string('telephone', 45)->nullable()->default('');
            $table->double('lat')->nullable()->default(0);
            $table->double('lng')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('es_order_shipping_address');
    }

}
