<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('es_billing_info', function(Blueprint $table)
		{
			$table->increments('id_billing_info');
			$table->integer('member_id');
			$table->string('payment_type', 45);
			$table->string('user_account', 255);
			$table->integer('bank_id');
			$table->string('bank_account_name', 255);
			$table->string('bank_account_number', 65);
			$table->tinyInteger('is_default');
			$table->timestamps();
			$table->tinyInteger('is_delete');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('es_billing_info');
	}

}
