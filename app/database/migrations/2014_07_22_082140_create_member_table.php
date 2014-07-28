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
            $table->integer('id_member',true,true);
            $table->string('username');
            $table->string('usersession')->nullable();
            $table->string('password');
            $table->integer('contactno');
            $table->tinyInteger('is_contactno_verify')->default(0);
            $table->string('email');
            $table->tinyInteger('is_email_verify')->default(0);
            $table->string('gender')->default(0);
            $table->date('birthday')->default('0001-01-01');
            $table->dateTime('datecreated');
            $table->dateTime('lastmodifieddate');
            $table->dateTime('last_login_datetime');
            $table->string('last_login_ip');
            $table->integer('login_count')->default(0);
            $table->string('fullname')->nullable();
            $table->string('nickname')->nullable();
            $table->string('imgurl')->nullable();
            $table->text('userdata')->nullable();
            $table->string('remarks')->nullable();
            $table->tinyInteger('is_admin')->default(0);
            $table->text('store_desc')->nullable();
            $table->tinyInteger('is_promo_valid')->default(0);
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
