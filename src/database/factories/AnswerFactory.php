<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->realText(),
            'thread_id' => Factory::factoryForModel(Thread::class)->create()->id,
            'user_id' => Factory::factoryForModel(User::class)->create()->id
        ];
    }
}
