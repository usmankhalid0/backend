<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete',
            'uer-list',
            'uer-create',
            'uer-edit',
            'uer-delete',

        ];
        foreach($permissions as $per)
        {
            Permission::create(['name' => $per]);
        }
    }
}
