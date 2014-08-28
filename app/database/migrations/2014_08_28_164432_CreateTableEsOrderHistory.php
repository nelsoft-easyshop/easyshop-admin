<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEsOrderHistory extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es_order_history', function(Blueprint $table)
        {
            $table->increments('id_order_history');
            $table->integer('order_id');
            $table->string('comment', 1024);
            $table->datetime('date_added');
            $table->integer('order_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('es_order_history');
    }

}
