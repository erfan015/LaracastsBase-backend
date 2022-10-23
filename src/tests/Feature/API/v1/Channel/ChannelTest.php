<?php

namespace Tests\Feature\API\v1\Channel;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use function config;
use function route;

//use function route;

class  ChannelTest extends TestCase
{
 use RefreshDatabase;


//    public function createFakeUserAndSetPersmissions()
//    {
//        $this->registerRolesAndPermissions();
//        $user=Factory::factoryForModel(User::class)->create();
//        $user->givePermissionTo('channel management');
//    }

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

    /**
     * test show all channels
     */
    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.list'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * test create channel
     */
    public function test_create_channel_should_be_validated()
    {

        $this->registerRolesAndPermissions();
        $user=Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');

        $response = $this->postJson(route('channel.create'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);


    }

    public function test_create_new_channel()
    {
        $this->registerRolesAndPermissions();
        $user=Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $response = $this->postJson(route('channel.create'), [
            'name' => 'laravel',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * test update channel
     */
    public function test_channel_update()
    {

        $this->registerRolesAndPermissions();
        $user=Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $channel = Factory::factoryForModel(Channel::class)->create([

            'name' => 'laravel'
        ]);

        $response = $this->json('PUT',route('channel.update'),[

            'id' => $channel->id,
            'name' => 'vue.js',
        ]);
        $updatedChannel=Channel::find($channel->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('vue.js',$updatedChannel->name);

    }

    public function test_channel_delete_should_be_validate()
    {
        $this->registerRolesAndPermissions();
        $user=Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $response = $this->json('DELETE',route('channel.delete'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    public function test_delete_channel()
    {
        $this->registerRolesAndPermissions();
        $user=Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management');
        $channel=Factory::factoryForModel(Channel::class)->create();

        $response = $this->json('DELETE',route('channel.delete'),[

           'id' => $channel->id,

        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

}
