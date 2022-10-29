<?php

namespace Tests\Feature\API\v1\Thread;

use App\Models\Answer;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AnswerTest extends TestCase
{
 use RefreshDatabase;

    /**
     * @test
     */

    public function can_get_all_answers()
    {
        $response = $this->get(route('answers.index'));

        $response->assertSuccessful();
    }

    /**
     * @test
     */

    public function create_answers_should_be_validated()
    {
        $response = $this->postJson(route('answers.store'),[]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function can_submit_new_answer_thread()
    {
//        $this->withoutExceptionHandling();
        Sanctum::actingAs(Factory::factoryForModel(User::class)->create());
        $thread= Factory::factoryForModel(Thread::class)->create();
        $response = $this->postJson(route('answers.store'),[
            'content' => 'Foo',
            'thread_id' => $thread->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertTrue($thread->answers()->where('content', 'Foo')->exists());



    }

    /**
     * @test
     */
    public function update_answers_should_be_validated()
    {
        $answer = Factory::factoryForModel(Answer::class)->create();
        $response = $this->putJson(route('answers.update',$answer));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    /**
     * @test
     */
    public function update_answers()
    {
        Sanctum::actingAs(Factory::factoryForModel(User::class)->create());
        $answer = Factory::factoryForModel(Answer::class)->create([
            'content' => 'Foo',
        ]);
        $response = $this->putJson(route('answers.update',$answer),[
            'content' => 'Bar'
        ]);

        $answer->refresh();

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Bar',$answer->content);

    }

}
