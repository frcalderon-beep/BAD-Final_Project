<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceType>
 */
class ServiceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = [
            'Hair Cutting',
            'Hair Coloring',
            'Manicure',
            'Pedicure',
            'Facial Treatment',
            'Massage Therapy',
            'Beard Trimming',
            'Deep Cleaning',
            'Waxing',
            'Consultation',
        ];

        return [
            'service_name' => $this->faker->randomElement($services),
            'duration' => $this->faker->randomElement([30, 45, 60, 90, 120]),
            'description' => $this->faker->sentence(),
            'cost' => $this->faker->randomFloat(2, 10, 150),
        ];
    }
}
