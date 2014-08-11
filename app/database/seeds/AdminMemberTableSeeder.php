<?php

class AdminMemberTableSeeder extends Seeder
{

    public function run()
    {
		DB::table('es_admin_member')->delete();
        AdminMember::create([
            'fullname' => 'Inon Baguio',
            'username' => 'inonbaguio',
            'password' => Hash::make('inonbaguio'),
        ]);
    }

}
