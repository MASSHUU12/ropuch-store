<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetails>
 */
class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => fake()->unique()->numberBetween(1, 128),
            'buyer_name' => fake()->name(),
            'buyer_email' => fake()->unique()->safeEmail(),
            'delivery_address' => fake()->address(),
            'delivery_city' => fake()->city(),
            'delivery_zip' => fake()->postcode(),
            'delivery_country' => fake()->country(),
        ];
    }
}
