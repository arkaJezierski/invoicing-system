<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExchangeRate>
 */
class ExchangeRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'currency_code' => $this->faker->currencyCode(),
            'effective_date' => $this->faker->date(),
            'mid' => $this->faker->randomFloat(4, 1, 5),
            'bid' => $this->faker->randomFloat(4, 1, 5),
            'ask' => $this->faker->randomFloat(4, 1, 5)
        ];
    }
}
