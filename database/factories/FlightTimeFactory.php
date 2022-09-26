<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\FlightTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FlightTimeFactory extends Factory
{
    protected $model = FlightTime::class;

    public function definition(): array
    {
        Carbon::setTestNowAndTimezone(Carbon::create(2022, tz: 'UTC'));

        $time = Carbon::now()
          ->addMinutes($this->faker->randomNumber())
          ->addHours($this->faker->randomNumber());

        return [
            'total' => $time,
            'night' => Carbon::create(),
            'xc' => Carbon::now(),
            'actual_inst' => Carbon::now(),
            'pic' => $time,
            'sic' => Carbon::now(),
            'dual_rcvd' => Carbon::now(),
            'solo' => Carbon::now(),
            'day_to' => $this->faker->randomNumber(),
            'night_to' => $this->faker->randomNumber(),
            'day_ldg' => $this->faker->randomNumber(),
            'night_ldg' => $this->faker->randomNumber(),
            'remarks' => $this->faker->word(),

            'flight_id' => Flight::factory(),
        ];
    }
}
