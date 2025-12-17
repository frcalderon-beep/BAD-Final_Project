<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Staff;
use App\Models\ServiceType;
use App\Models\System;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Systems first
        System::factory(2)->create();

        // Create Clients
        Client::factory(15)->create();

        // Create Staff
        Staff::factory(8)->create();

        // Create Service Types
        ServiceType::factory(10)->create();

        // Create Appointments
        Appointment::factory(30)->create();

        // Create Schedules
        Schedule::factory(20)->create();

        // Create Test User (only if doesn't exist)
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
    }
}
