<?php

return [
    'users1' => [
        'base_uri' => env('USERS1_SERVICE_BASE_URL','https://microservice-ddsbe1.onrender.com/users'),
        'secret' => env('USERS1_SERVICE_SECRET'),
    ],
    'users2' => [
        'base_uri' => env('USERS2_SERVICE_BASE_URL', 'https://microservice-ddsbe2.onrender.com/users'),
        'secret' => env('USERS2_SERVICE_SECRET'),
    ],
];