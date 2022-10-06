<?php

namespace Database\Seeders;

use App\Models\Flight;
use Database\Factories\FlightFactory;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        Flight::factory()
            ->count(30)
            ->create();
    }
}
