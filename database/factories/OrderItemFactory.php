<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => fake()->numberBetween(1, 256),
            'product_id' => fake()->numberBetween(1, 100),
            'quantity' => fake()->numberBetween(1, 10),
            'price' => fake()->randomFloat(2, 1, 1000),
        ];
    }
}
