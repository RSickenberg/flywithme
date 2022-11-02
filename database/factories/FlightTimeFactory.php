<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\FlightTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FlightTimeFactory extends Factory
{
    protected $model = FlightTime::class;

    public function definition(): array
    {
        Carbon::setTestNowAndTimezone(Carbon::create(2022, tz: 'UTC'));

        $time = Carbon::now()
          ->addMinutes($this->faker->randomNumber(1))
          ->addHours($this->faker->randomNumber(1));

        return [
            'id' => Str::ulid()->toBase32(),
            'total' => $time->toTimeString(),
            'night' => Carbon::create(),
            'xc' => Carbon::now(),
            'actual_inst' => Carbon::now(),
            'pic' => $time->toTimeString(),
            'sic' => Carbon::now(),
            'dual_rcvd' => Carbon::now(),
            'solo' => Carbon::now(),
            'day_to' => $this->faker->randomNumber(1),
            'night_to' => $this->faker->randomNumber(1),
            'day_ldg' => $this->faker->randomNumber(1),
            'night_ldg' => $this->faker->randomNumber(1),
            'remarks' => $this->faker->word(),

            'flight_id' => Flight::factory(),
        ];
    }
}
