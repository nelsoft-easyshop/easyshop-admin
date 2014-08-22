<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es_cat', function(Blueprint $table)
        {
            $table->increments('id_cat');
            $table->string('name')->default('');
            $table->string('description',512)->default('');
            $table->string('keywords',512)->default('');
            $table->integer('parent_id');
            $table->tinyInteger('sort_order');
            $table->tinyInteger('is_main');
            $table->string('design1')->default('');
            $table->string('design2')->default('');
            $table->string('design3')->default('');
            $table->string('slug')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('es_cat');
    }

}
