<?php

namespace App\Models;

use App\Enum\FlightStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
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
    use HasUlids;

    protected $fillable = [
        'registration', 'model', 'flight_number', 'departure', 'arrival',
        'out', 'in', 'metar', 'route', 'departure_location', 'arrival_location',
        'status',
    ];

    protected $casts = [
        'departure_location' => Point::class,
        'arrival_location' => Point::class,
        'status' => FlightStatus::class,
    ];

    public function times(): HasOne
    {
        return $this->hasOne(FlightTime::class);
    }

    public function scopeInFuture(): SpatialBuilder
    {
        /** @var $builder SpatialBuilder */
        return $this
            ->whereDate('out', '>=', Carbon::now())
            ->whereStatus(FlightStatus::ACTIVE)
            ->orWhere('status', '=', FlightStatus::POSTPONED);
    }

    public function scopePassed(): SpatialBuilder
    {
        /** @var SpatialBuilder */
        return $this
            ->whereDate('out', '<=', Carbon::now())
            ->whereNot('status', '=', FlightStatus::ACTIVE)
            ->whereNot('status', '=', FlightStatus::POSTPONED);
    }

    public function getStatusClass(): string
    {
        return match ($this->status) {
            FlightStatus::ACTIVE => 'bg-green-100 text-green-800',
            FlightStatus::POSTPONED => 'bg-yellow-100 text-yellow-800',
            FlightStatus::DROPPED => 'bg-red-100 text-red-800',
            FlightStatus::ARCHIVED => 'bg-gray-100 text-gray-800',
        };
    }

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }

}
