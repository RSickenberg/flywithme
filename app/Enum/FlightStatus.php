<?php

namespace App\Enum;

enum FlightStatus: string
{
    case ACTIVE = 'active';
    case POSTPONED = 'postponed';
    case DROPPED = 'dropped';
    case ARCHIVED = 'archived';
}
