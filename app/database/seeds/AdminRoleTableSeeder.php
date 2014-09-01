<?php
class AdminRoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('es_admin_member_role')->delete();
        AdminRoles::create([
            'role_name' => 'CONTENT',
        ]);            
        AdminRoles::create([
            'role_name' => 'CSR',
        ]); 
        AdminRoles::create([
            'role_name' => 'MARKETING',
        ]);         
        AdminRoles::create([
            'role_name' => 'SUPER-USER',
        ]);         
    }
}
