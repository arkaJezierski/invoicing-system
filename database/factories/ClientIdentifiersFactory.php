<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientIdentifier>
 */
class ClientIdentifiersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'client_id' => $this,
            'type' => $this,
            'value' => $this,
            'country_id' => $this
        ];
    }
}
