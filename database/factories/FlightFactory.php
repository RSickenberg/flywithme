<?php

namespace Database\Factories;

use App\Enum\FlightStatus;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use MatanYadaev\EloquentSpatial\Objects\Point;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    /**
     * @throws \Exception
     */
    public function definition(): array
    {
        $rawMetars = [
            'METAR LSMP 061350Z AUTO 05005KT 350V090 9999NDV NCD 21/13 Q1029 RMK',
            'METAR LSGG 061350Z 06006KT 9999 FEW042 21/13 Q1028 NOSIG',
            'METAR LSGC 061350Z 05008KT 9999 SCT015 BKN023 14/11 Q1031',
            'METAR LSGS 061350Z 26011KT CAVOK 23/11 Q1027',
            'METAR EHAM 061355Z 25015KT 210V280 9999 FEW034 16/08 Q1028 NOSIG',
            'METAR KJFK 061351Z 01009KT 10SM FEW043 FEW250 17/09 A2999 RMK AO2 SLP155 T01670089',
        ];

        return [
            'registration' => $this->faker->randomElement(['HB-ABC', 'HB-HFH', 'HB-CCV', 'HB-HFK']),
            'model' => $this->faker->randomElement(['CESSNA', 'BRAVO', 'DIAMOND', 'PILATUS', 'MOONEY', 'PIPER', 'BEECH']),
            'flight_number' => $this->faker->randomNumber(4),
            'departure' => $this->faker->randomElement(['LSGL', 'LSGG', 'LSGN', 'LSGS', 'LSGY', 'LSGZ']),
            'arrival' => $this->faker->randomElement(['LSGL', 'LSGG', 'LSGN', 'LSGS', 'LSGY', 'LSGZ']),
            'out' => Carbon::now()->toDateTimeString(),
            'in' => Carbon::now()->addHours(random_int(1, 7))->toDateTimeString(),
            'metar' => $this->faker->randomElement($rawMetars),
            'route' => $this->faker->word(),
            'departure_location' => new Point($this->faker->latitude(), $this->faker->longitude()),
            'arrival_location' => new Point($this->faker->latitude(), $this->faker->longitude()),
            'status' => $this->faker->randomElement(array_map(static fn(\BackedEnum $enum) => $enum->value,FlightStatus::cases())),
        ];
    }
}
