<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusTable extends Migration 
{

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('es_order_status', function(Blueprint $table)
        {
            $table->increments('id_order_status');
            $table->string('name', 150);
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
        Schema::drop('es_order_status');
    }

}
