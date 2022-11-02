<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\FlightTime;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        Flight::factory()
            ->has(FlightTime::factory(), 'times')
            ->count(15)
            ->create();
    }
}
