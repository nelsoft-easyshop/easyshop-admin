<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderStatusSignedInteger extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update(DB::raw('ALTER TABLE `es_order_status` CHANGE COLUMN `order_status` `order_status` INT SIGNED;'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::update(DB::raw('ALTER TABLE `es_order_status` CHANGE COLUMN `order_status` `order_status` INT UNSIGNED;'));
    }

}
