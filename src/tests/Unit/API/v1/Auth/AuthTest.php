<?php

namespace Tests\Unit\API\v1\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;


    public function registerRolesAndPermissions()
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


    public function test_Register_should_be_validated()
    {

        $response = $this->postJson('api/v1/auth/register');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);


    }


    public function test_new_user_can_register()
    {
        $this->registerRolesAndPermissions();
        $response = $this->postJson('api/v1/auth/register', [
            'name' => 'erfan',
            'email' => 'erfanansari@yahoo.com',
            'password' => '123456',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);


    }

    public function test_login_user_should_be_validated()
    {

        $response = $this->postJson('api/v1/auth/login');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    public function test_new_user_can_login_with_true_credential()
    {
        $user = Factory::factoryForModel(User::class)->create();

        $response = $this->postJson('api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_logged_in_user_can_logout()
    {
        $user = Factory::factoryForModel(User::class)->create();

        $response = $this->actingAs($user)->postJson('api/v1/auth/logout');

        $response->assertStatus(Response::HTTP_OK);

    }


}
