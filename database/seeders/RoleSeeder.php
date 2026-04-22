<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswaRole = Role::create(['name' => 'mahasiswa']);
        $dosenRole = Role::create(['name' => 'dosen']);

        $dosenPermissions = [
            'view-users',
            'create-users',
            'update-users',
            'delete-users',
        ];
        foreach ($dosenPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $dosenRole->givePermissionTo($dosenPermissions);
       
    }
}
