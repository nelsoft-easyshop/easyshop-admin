<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es_product', function(Blueprint $table)
        {
            $table->integer('id_product',true,true);
            $table->string('name');
            $table->string('sku');
            $table->string('brief');
            $table->text('description');
            $table->string('condition')->nullable();
            $table->string('keywords',1024);
            $table->text('search_keyword')->nullable();
            $table->decimal('price',15,4)->default(0.0000);
            $table->integer('brand_id',false,true)->default(0);
            $table->integer('cat_id',false,true)->default(0);
            $table->integer('style_id',false,true)->default(0);
            $table->integer('is_real',false,true)->default(0);
            $table->integer('is_delete',false,true)->default(0);
            $table->integer('is_new',false,true)->default(0);
            $table->integer('is_hot',false,true)->default(0);
            $table->integer('is_promote',false,true)->default(0);
            $table->integer('member_id',false,true)->default(0);
            $table->string('member_memo',1024);
            $table->dateTime('createddate');
            $table->dateTime('lastmodifieddate');
            $table->integer('clickcount',false,true)->default(0);
            $table->string('cat_other_name',150);
            $table->string('brand_other_name',150);
            $table->integer('is_draft',false,true)->default(0);
            $table->integer('billing_info_id')->default(0);
            $table->integer('is_cod')->default(0);
            $table->string('slug');
            $table->decimal('discount',15,4)->default(0.0000);
            $table->dateTime('startdate');
            $table->dateTime('enddate');
            $table->integer('promo_type')->default(0);
            $table->integer('is_sold_out')->default(0);
        });
    }
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
    public function down()
    {
        Schema::drop('es_product');
    }
}
