<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign created permissions
        $Admin          = Role::create(['name' => 'Admin']);
        $Auditor         = Role::create(['name' => 'Auditor']);
        $Auditee         = Role::create(['name' => 'Auditee']);

        // create new user
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'username' => 'admin',
            // 'email' => 'cek@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('Admin');


        $user = \App\Models\User::create([
            'name' => 'Dosen auditor',
            'username' => 'auditor',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('Auditor');


        $user = \App\Models\User::create([
            'name' => 'Fakultas Teknik',
            'username' => 'teknik',
            'password' => bcrypt('password'),
        ]);
        // auditee
        \App\Models\Auditee::create([
            'id_user' => $user->id,
            'level' => 'fakultas',
        ]);
        $user->assignRole('Auditee');
        
        
    }
}
