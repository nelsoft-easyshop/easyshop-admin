<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransactionIdVarchar extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update(DB::raw('ALTER TABLE `es_order` CHANGE COLUMN `transaction_id` `transaction_id` VARCHAR(1024);'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::update(DB::raw('ALTER TABLE `es_order` CHANGE COLUMN `transaction_id` `transaction_id` INT;'));
    }

}
