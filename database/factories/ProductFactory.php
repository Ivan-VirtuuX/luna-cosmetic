<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'desc' => $this->faker->sentence(),
            'full_desc' => $this->faker->sentence(),
            'uses' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(100, 10000),
            'amount' => $this->faker->sentence(),
        ];
    }
}
