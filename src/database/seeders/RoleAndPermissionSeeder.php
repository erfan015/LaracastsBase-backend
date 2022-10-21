<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        /**
         * check Roles : exist or not exist in database , if not exist: create them
         */
        $roleInDatabase = Role::query()->where('name',config('permission.default_roles')[0]);
        if($roleInDatabase->count() < 1)
        {
            foreach (config('permission.default_roles') as $role)
            {
                Role::create([

                    'name' => $role,
                ]);
            }
        }


        /**
         * check Permissions : exist or not exist in database , if not exist: create them
         */

        $permissionInDatabase = Permission::query()->where('name',config('permission.default_permissions')[0]);
        if($permissionInDatabase->count() < 1)
        {
            foreach (config('permission.default_permissions') as $permission)
            {
                Permission::create([

                    'name' => $permission,
                ]);
            }
        }

    }
}
