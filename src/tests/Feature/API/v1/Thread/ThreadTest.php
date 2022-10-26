<?php

namespace Tests\Feature\API\v1\Thread;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
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

    /**
     * @test
     */

    public function thread_create_should_be_validate()
    {
        $response = $this->postJson(route('threads.store'), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function create_thread()
    {

        Sanctum::actingAs(Factory::factoryForModel(User::class)->create());
        $response = $this->postJson(route('threads.store'), [
            'title' => 'Foo',
            'content' => 'Bar',
            'channel_id' => Factory::factoryForModel(Channel::class)->create()->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * @test
     */

    public function update_thread_should_be_validate()
    {
        Sanctum::actingAs(Factory::factoryForModel(User::class)->create());
        $thread = Factory::factoryForModel(Thread::class)->create();
        $response = $this->putJson(route('threads.update', [$thread]));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

   /**
    * @test
    */

    public function update_thread()
    {
        $user = Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);
        $thread = Factory::factoryForModel(Thread::class)->create([
            'title' => 'Foo',
            'content' => 'Bar',
            'channel_id' => Factory::factoryForModel(Channel::class)->create()->id,
            'user_id' => $user->id,
        ]);

        $response = $this->putJson(route('threads.update', [$thread]), [
            'title' => 'Bar',
            'content' => 'Bar',
            'channel_id' => Factory::factoryForModel(Channel::class)->create()->id,
        ])->assertSuccessful();

        $thread->refresh();
        $this->assertSame('Bar' ,$thread->title);
    }


    /**
     * @test
     */
    public function can_add_best_answer_id_for_thread()
    {
        $user = Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);

        $thread = Factory::factoryForModel(Thread::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->putJson(route('threads.update', [$thread]), [
            'best_answer_id' => 1,
        ])->assertSuccessful();

        $thread->refresh();
        $this->assertSame(1 ,$thread->best_answer_id);
    }

    /**
     * @test
     */
    public function thread_delete()
    {

        $user = Factory::factoryForModel(User::class)->create();
        Sanctum::actingAs($user);
        $thread = Factory::factoryForModel(Thread::class)->create([
            'user_id' => $user->id
        ]);
        $response = $this->delete(route('threads.destroy',[$thread->id]));

        $response->assertStatus(Response::HTTP_OK);
    }
}
