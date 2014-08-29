<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('es_product_image', function(Blueprint $table)
		{
			$table->increments('id_product_image',true,true);
			$table->text('product_image_path');
			$table->string('product_image_type',1024);
			$table->integer('product_id',false,true)->default(0);
			 $table->tinyInteger('is_primary')->default(0);
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('es_product_image');
	}

}
