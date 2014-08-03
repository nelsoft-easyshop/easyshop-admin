<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingCommentTable extends Migration {

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
            $table->integer('order_product_id');
            $table->string('courier', 255);
            $table->string('tracking_num', 255);
            $table->text('comment');
            $table->integer('member_id');
            $table->dateTime('expected_date');
            $table->dateTime('delivery_date');
            $table->timestamps('');
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
