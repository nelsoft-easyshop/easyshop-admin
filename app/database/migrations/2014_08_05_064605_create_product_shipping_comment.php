<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductShippingComment extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es_product_shipping_comment', function(Blueprint $table)
        {
            $table->increments('id_shipping_comment');
            $table->integer('order_product_id')->default(0);
            $table->string('courier', 45)->default('')->nullable();
            $table->string('tracking_num', 45)->default('')->nullable();
            $table->string('comment', 450)->default('')->nullable();
            $table->integer('member_id')->default(0);
            $table->timestamp('delivery_date');
            $table->timestamp('expected_date');
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
        Schema::drop('es_product_shipping_comment');
    }

}
