<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsPromoValid extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update(DB::raw('ALTER TABLE `es_member` ADD COLUMN `is_promo_valid` TINYINT(3) DEFAULT 0;'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::update(DB::raw('ALTER TABLE `es_member` DROP COLUMN `is_promo_valid`;'));
    }

}
