<?php
class AdminMemberTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('es_admin_member')->delete();
        AdminMember::create([
            'fullname' => 'Sam Gavinio',
            'username' => 'samgavinio',
            'password' => Hash::make('laude2511')
        ]);
        AdminMember::create([
            'fullname' => 'Kurt Wilkinson Pasamba',
            'username' => 'kurt',
            'password' => Hash::make('kurt123')
        ]);
    }
}
