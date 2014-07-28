<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('es_address', function(Blueprint $table)
		{
			$table->increments('id_address');
			$table->integer('id_member');
			$table->integer('stateregion')->nullable()->default(0);
			$table->integer('city')->nullable()->default(0);
			$table->integer('country')->nullable()->default(0);
			$table->string('address')->nullable()->default('');
			$table->tinyInteger('type')->nullable()->default(0);
			$table->string('telephone',45)->nullable()->default('');
			$table->string('mobile',45)->nullable()->default('');
			$table->string('consignee',45)->nullable()->default('');
			$table->float('lat')->nullable()->default(0);
			$table->float('lng')->nullable()->default(0);
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
		Schema::drop('es_address');
	}

}
