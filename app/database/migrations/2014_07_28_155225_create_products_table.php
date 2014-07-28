<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('es_product', function(Blueprint $table)
		{
			$table->increments('id_product');
			$table->string('name',255);
			$table->string('sku',45);
			$table->string('brief',255);
            $table->text('description');
			$table->string('condition', 255);
			$table->string('keywords', 1024);
			$table->decimal('price', 15, 4);
			$table->integer('brand_id');
			$table->integer('cat_id');
			$table->integer('style_id');
			$table->tinyInteger('is_real');
			$table->tinyInteger('is_delete');
			$table->tinyInteger('is_new');
			$table->tinyInteger('is_hot');
			$table->tinyInteger('is_promote');
			$table->integer('member_id');
			$table->string('member_memo', 1024);
			$table->timestamps();
			$table->integer('clickcount');
			$table->string('cat_other_name', 150);
			$table->string('brand_other_name', 150);
			$table->tinyInteger('is_draft');
			$table->integer('billing_info_id');
			$table->tinyInteger('is_cod');
			$table->string('slug',255);
			$table->decimal('discount', 15, 4);
			$table->timestamp('startdate');
			$table->timestamp('enddate');
			$table->tinyInteger('promo_type');
			$table->tinyInteger('is_sold_out');
			$table->string('search_keyword', 1024);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('es_products');
	}

}
