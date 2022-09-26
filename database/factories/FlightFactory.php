<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use MatanYadaev\EloquentSpatial\Objects\Point;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        Carbon::setTestNowAndTimezone(Carbon::create(2022, tz: 'UTC'));

        return [
            'registration' => $this->faker->randomElement(['HB-ABC', 'HB-HFH', 'HB-CCV', 'HB-HFK']),
            'model' => $this->faker->randomElement(['CESSNA', 'BRAVO']),
            'flight_number' => $this->faker->randomNumber(4),
            'departure' => $this->faker->randomElement(['LSGL', 'LSGG', 'LSGN', 'LSGS', 'LSGY', 'LSGZ']),
            'arrival' => $this->faker->randomElement(['LSGL', 'LSGG', 'LSGN', 'LSGS', 'LSGY', 'LSGZ']),
            'out' => Carbon::now(),
            'in' => Carbon::now()->addHours($this->faker->randomNumber()),
            'metar' => $this->faker->word(),
            'route' => $this->faker->word(),
            'departure_location' => new Point($this->faker->latitude(), $this->faker->longitude()),
            'arrival_location' => new Point($this->faker->latitude(), $this->faker->longitude()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
