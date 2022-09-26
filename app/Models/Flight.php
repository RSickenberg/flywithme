<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

/**
 * @method static SpatialBuilder query()
 */
class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration', 'model', 'flight_number', 'departure', 'arrival',
        'out', 'in', 'metar', 'route', 'departure_location', 'arrival_location',
    ];

    protected $casts = [
        'departure_location' => Point::class,
        'arrival_location' => Point::class,
    ];

    public function times(): HasOne
    {
        return $this->hasOne(FlightTime::class);
    }

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }
}
