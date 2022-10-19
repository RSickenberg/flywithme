<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightTime extends Model
{
    use HasFactory;
    use HasUlids;

    protected $table = 'flights_times';

    public $timestamps = false;

    protected $fillable = [
        'flight_id', 'total', 'night', 'xc', 'actual_inst', 'pic', 'sic', 'dual_rcbd', 'solo',
        'day_to', 'night_to', 'day_ldg', 'night_ldg', 'remarks',
    ];

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}
