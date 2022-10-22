<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->realText(),
            'user_id' => self::factoryForModel(User::class)->create()->id,
            'channel_id' => self::factoryForModel(Channel::class)->create()->id,
        ];
    }
}
