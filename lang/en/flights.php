<?php

return [
    'header' => 'Flights',
    'sub_header' => 'See all the flights in the future or add a new one.',
    'add' => 'Add Flight',

    'table' => [
        'id' => '#',
        'registration' => 'Registration',
        'model' => 'Aircraft Model',
        'date' => 'Date',
        'from' => 'From',
        'to' => 'To',
        'status' => 'Status',

        'action' => [
            'edit' => 'Edit',
            'include_passed' => 'Show old / archived',
        ],
    ],

    'create' => [
        'header' => 'Create a new Flight',
        'form' => [
            'fieldsets' => [
                'base_data' => 'Base Data',
                'nav' => 'Navigation',
                'tz' => 'Timezones',
                'geo' => 'Positions',
            ],
            'wizard' => [
                'general' => 'General',
                'geo' => [
                    'label' => 'Geolocation',
                    'desc' => 'Input all information regarding the flight data'
                ]
            ],
            'status' => 'Status',
            'registration' => 'Registration',
            'model' => 'Model',
            'flight_number' => 'Flight number',
            'departure' => 'Departure',
            'arrival' => 'Arrival',
            'out' => 'Date of departure',
            'in' => 'Date of return',
            'metar' => 'Metar',
            'metar_placeholder' => 'If available, insert here the METAR for the flight.',
            'route' => 'Route',
            'legs' => 'Legs',
            'timezone_departure' => 'Timezone of departure',
            'timezone_arrival' => 'Timezone of arrival'
        ],
    ],
];
