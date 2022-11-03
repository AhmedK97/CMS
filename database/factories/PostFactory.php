<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(15),
            'slug' => $this->faker->name,
            'body' =>$this->faker->realText(600),
            'user_id' =>random_int(1,3),
            'approved' => true,
            'category_id' => random_int(1,6),
        ];
    }
}
