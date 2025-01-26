<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reviews>
 */
class reviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => $this->faker->numberBetween(1,5),
            'rest_items_id' => $this->faker->numberBetween(1,5),
            'description' => $this->faker->text(),
            'rating' => $this->faker->numberBetween(0, 5),

        ];
    }
}
