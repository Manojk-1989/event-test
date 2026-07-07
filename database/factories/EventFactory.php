<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'venue' => fake()->city(),
            'event_date' => fake()->dateTimeBetween('+1 week', '+3 months'),
            'capacity' => fake()->numberBetween(20, 200),
        ];
    }
}
