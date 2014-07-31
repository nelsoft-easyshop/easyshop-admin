<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration 
{

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
            $table->integer('stateregion');
            $table->integer('city');
            $table->integer('country');
            $table->string('address');
            $table->tinyInteger('type');
            $table->string('telephone',45);
            $table->string('mobile',45);
            $table->string('consignee',45);
            $table->float('lat');
            $table->float('lng');
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
