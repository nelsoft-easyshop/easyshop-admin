<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es_location_lookup', function(Blueprint $table)
        {
            $table->integer('id_location',true,true);
            $table->integer('parent_id',false,true)->default(0);
            $table->string('location',45);
            $table->integer('type')->default(0);
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
        Schema::drop('es_location_lookup');
    }
}
