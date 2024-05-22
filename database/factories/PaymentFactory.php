<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => fake()->unique()->numberBetween(1, 256),
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'stripe']),
            'transaction_id' => fake()->unique()->uuid,
            'amount' => fake()->randomFloat(2, 1, 1000),
            'status' => fake()->randomElement(['pending', 'completed', 'failed']),
            'currency' => fake()->randomElement(['USD', 'EUR', 'GBP']),
        ];
    }
}
