<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es_brand', function(Blueprint $table)
        {
            $table->increments('id_brand');
            $table->string('name')->default('');
            $table->string('description',1024)->default('');
            $table->string('image',512)->default('');
            $table->tinyInteger('sort_order')->default(0);
            $table->string('url',512)->default('');
            $table->tinyInteger('is_main')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('es_brand');
    }

}
