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
            $table->integer('id_role',true,true);
            $table->string('role_name');
            $table->integer('admin_member_id')->default(0);
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
