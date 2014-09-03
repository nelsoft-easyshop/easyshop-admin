<?php

class OrderStatusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('es_order_status')->delete();
        OrderStatus::create([
            'order_status' => '0',
            'name' => 'PAID'
        ]);
        OrderStatus::create([
            'order_status' => '1',
            'name' => 'COMPLETE'
        ]);
        OrderStatus::create([
            'order_status' => '2',
            'name' => 'VOID'
        ]);
        OrderStatus::create([
            'order_status' => '99',
            'name' => 'DRAFT'
        ]);

    }
}
