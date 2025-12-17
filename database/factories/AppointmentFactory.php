<?php

namespace Database\Factories;

use App\Models\System;
use App\Models\Client;
use App\Models\Staff;
use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serviceType = ServiceType::inRandomOrder()->first() ?? ServiceType::factory()->create();
        $client = Client::inRandomOrder()->first() ?? Client::factory()->create();
        $staff = Staff::inRandomOrder()->first() ?? Staff::factory()->create();
        $system = System::inRandomOrder()->first() ?? System::factory()->create();

        $statuses = ['scheduled', 'completed', 'cancelled'];

        return [
            'system_id' => $system->id,
            'client_id' => $client->id,
            'staff_id' => $staff->id,
            'service_type_id' => $serviceType->id,
            'service_name' => $serviceType->service_name,
            'appointment_date_time' => $this->faker->dateTimeBetween('+1 day', '+30 days'),
            'personal_references' => $this->faker->optional()->paragraph(),
            'appointment_status' => $this->faker->randomElement($statuses),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
