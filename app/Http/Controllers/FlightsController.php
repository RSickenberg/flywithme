<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightIndexFilter;
use App\Models\Flight;
use Illuminate\Contracts\View\View;

class FlightsController extends Controller
{
    public function __construct(protected Flight $flight) {}

    public function index(FlightIndexFilter $request): View
    {
        $flights = $request->validated('old') ?
            $this->flight
                ->passed()
                ->paginate(10) :
            $this->flight
                ->inFuture()
                ->paginate(10);

        return view('flights.index', [
            'flights' => $flights,
        ]);
    }

}
