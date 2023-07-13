<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Breed>
 */
class BreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'age' => fake()->numberBetween(1, 2),
            'state' => fake()->randomElement(['Available', 'Adopted', 'In progress']),
            'likes' => fake()->numberBetween(),
            'image_id' => Image::factory(),
            'user_id' => User::factory(),
        ];
    }
}
