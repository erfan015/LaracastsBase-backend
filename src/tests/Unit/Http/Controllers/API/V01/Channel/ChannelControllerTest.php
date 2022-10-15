<?php

namespace Tests\Unit\Http\Controllers\API\V01\Channel;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{
 use RefreshDatabase;

    /**
     * test show all channels
     */
    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.list'));

        $response->assertStatus(200);
    }

    /**
     * test create channel
     */
    public function test_create_channel_should_be_validated()
    {
        $response = $this->postJson(route('channel.create'));

        $response->assertStatus(422);
    }

    public function test_create_new_channel()
    {
        $response = $this->postJson(route('channel.create'), [
            'name' => 'laravel',
        ]);

        $response->assertStatus(201);
    }
}
