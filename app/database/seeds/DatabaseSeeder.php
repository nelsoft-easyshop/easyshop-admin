<?php

class DatabaseSeeder extends Seeder {

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Eloquent::unguard();
        
        $this->call('AdminMemberTableSeeder');
        $this->call('BankInfoTableSeeder');
        $this->call('LocationLookUpTableSeeder');
        $this->call('AdminRoleTableSeeder');

    }

}
