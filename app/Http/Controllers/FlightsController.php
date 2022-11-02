<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightIndexFilter;
use App\Models\Flight;
use Illuminate\Contracts\View\View;

class FlightsController extends Controller
{
    public function __construct(protected Flight $flight)
    {
    }

    public function index(FlightIndexFilter $request): View
    {
        $flights = $request->validated('old') ?
            $this->flight
                ->passed() :
            $this->flight
                ->inFuture();

        $flights = $flights
            ->paginate(10)
            ->withQueryString();

        return view('flights.index', [
            'flights' => $flights,
        ]);
    }
}
