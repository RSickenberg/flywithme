<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Contracts\View\View;

class FlightsController extends Controller
{
    public function __construct(protected Flight $flight)
    {
    }

    public function index(): View
    {
        return view('flights.index');
    }
}
