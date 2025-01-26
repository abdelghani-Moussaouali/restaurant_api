<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\restItem>
 */
class restItemFactory extends Factory
{
    // {Database\Factories\Http\Requests\restItemFactory
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [

            'users_id' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->text(),
            'description' => $this->faker->text(),
            'email' => $this->faker->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'category' => 'pizza',
            'wilaya' => $this->faker->country(),
            'address' => $this->faker->streetAddress(),


        ];
    }
}
