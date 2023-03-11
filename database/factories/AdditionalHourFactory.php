<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalHour>
 */
class AdditionalHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reason' => fake()->sentence(),
            'date' => fake()->date(),
            'hours' => fake()->numberBetween(1,100)
        ];
    }
}
