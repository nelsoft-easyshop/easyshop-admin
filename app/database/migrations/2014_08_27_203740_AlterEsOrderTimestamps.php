<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEsOrderTimestamps extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update(DB::raw('ALTER TABLE `es_order` CHANGE COLUMN `created_at` `dateadded` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;'));
        DB::update(DB::raw('ALTER TABLE `es_order` CHANGE COLUMN `updated_at` `datemodified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::update(DB::raw('ALTER TABLE `es_order` CHANGE COLUMN `dateadded` `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;'));
        DB::update(DB::raw('ALTER TABLE `es_order` CHANGE COLUMN `datemodified` `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;'));
    }

}
