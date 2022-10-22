<?php

namespace Tests\Feature\API\v1\Thread;

use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function all_threads_list_should_be_accessible()
    {
        $response = $this->get(route('threads.index'));

        $response->assertStatus(Response::HTTP_OK);
    }


    public function test_thread_should_be_accessible_by_slug()
    {
        $thread = Factory::factoryForModel(Thread::class)->create();
        $response = $this->get(route('threads.show', [$thread->slug]));

        $response->assertStatus(Response::HTTP_OK);
    }
}
