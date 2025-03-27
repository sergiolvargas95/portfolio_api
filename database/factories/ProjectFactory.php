<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projects>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(),
            'repository_url' => $this->faker->url(),
            'demo_url' => $this->faker->url(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
