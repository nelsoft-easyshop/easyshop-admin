<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('es_order', function(Blueprint $table)
		{
			$table->increments('id_order');
			$table->string('invoice_no', 45);
			$table->decimal('total', 15, 4);
			$table->integer('buyer_id');
			$table->integer('payment_address_id');
			$table->integer('shipping_address_id');
			$table->integer('payment_method_id');
			$table->string('ip', 45);
			$table->integer('order_status');
			$table->integer('transaction_id');
			$table->decimal('easyshop_charge', 15, 4);
			$table->decimal('payment_method_charge', 15, 4);
			$table->decimal('net', 15, 4);
			$table->tinyInteger('is_flag');
			$table->tinyInteger('postbackcount');
			$table->text('dataresponse');
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
		Schema::drop('es_order');
	}

}
