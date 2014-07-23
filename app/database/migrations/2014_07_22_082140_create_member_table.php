<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('es_member', function(Blueprint $table)
		{
			$table->increments('id_member');
			$table->string('username', 255);
			$table->string('usersession', 255);
			$table->string('password', 255);
			$table->string('contactno', 45);
			$table->tinyInteger('is_contactno_verify');
			$table->string('email', 255);
			$table->tinyInteger('is_email_verify');
			$table->string('gender', 45);
			$table->date('birthday');
			$table->dateTime('last_login_datetime');
			$table->string('last_login_ip', 45);
			$table->integer('login_count');
			$table->string('fullname');
			$table->string('nickname');
			$table->string('imgurl');
			$table->text('userdata');
			$table->string('remarks', 255);
			$table->tinyInteger('is_admin');
			$table->string('storedesc', 1024);
	
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
		Schema::drop('es_member');
	}

}
