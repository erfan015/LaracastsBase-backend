<?php

namespace Tests\Unit\Http\Controllers\API\V01\Channel;

use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Database\Factories\ChannelFactory;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use const Grpc\CHANNEL_CONNECTING;

class ChannelControllerTest extends TestCase
{
 use RefreshDatabase;

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
        $response = $this->postJson(route('channel.create'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_new_channel()
    {
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
        $response = $this->json('DELETE',route('channel.delete'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    public function test_delete_channel()
    {
        $channel=Factory::factoryForModel(Channel::class)->create();

        $response = $this->json('DELETE',route('channel.delete'),[

           'id' => $channel->id,

        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

}
