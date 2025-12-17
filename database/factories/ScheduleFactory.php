<?php

namespace Database\Factories;

use App\Models\Staff;
use App\Models\System;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $staff = Staff::inRandomOrder()->first() ?? Staff::factory()->create();
        $system = System::inRandomOrder()->first() ?? System::factory()->create();

        return [
            'staff_id' => $staff->id,
            'system_id' => $system->id,
            'time' => $this->faker->dateTimeBetween('+1 day', '+30 days'),
            'available_slots' => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
