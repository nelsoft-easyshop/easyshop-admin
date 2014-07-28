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
			$table->integer('id_admin_member',true,true);
			$table->string('username');
			$table->string('password');
			$table->string('fullname');
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
