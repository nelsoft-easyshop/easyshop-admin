<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddRoleId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::update(DB::raw('ALTER TABLE `es_admin_member` ADD COLUMN `role_id` INT(10) DEFAULT 1;'));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::update(DB::raw('ALTER TABLE `es_admin_member` DROP COLUMN `role_id`;'));
	}

}
