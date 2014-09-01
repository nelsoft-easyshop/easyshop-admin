<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('es_admin_member_role', function(Blueprint $table)
        {
            $table->increments('id_role');
            $table->string('role_name');
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
        Schema::drop('es_admin_member_role');
	}

}
