<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMemberTable extends Migration 
{

   /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('es_admin_member', function(Blueprint $table)
        {
            $table->increments('id_admin_member');
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('fullname', 255);
            $table->timestamps();
            // required for Laravel 4.1.26
            $table->string('remember_token', 100)->nullable();
        });
    }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('es_admin_member');
    }

}
