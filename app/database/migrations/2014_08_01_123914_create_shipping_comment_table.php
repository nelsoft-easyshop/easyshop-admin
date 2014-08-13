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
            $table->integer('order_product_id')->default(0);
            $table->string('courier')->default('')->nullable();
            $table->string('tracking_num')->default('')->nullable();
            $table->text('comment');
            $table->integer('member_id')->default(0);
            $table->dateTime('expected_date')->nullable();
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
