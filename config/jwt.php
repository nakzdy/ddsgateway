<?php

return [
    'secret' => env('JWT_SECRET'),
    'keys' => [
        'public' => env('JWT_PUBLIC_KEY'),
        'private' => env('JWT_PRIVATE_KEY'),
    ],
    'ttl' => env('JWT_TTL', 60),  // Token lifetime in minutes
    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),  // Refresh lifetime in minutes
    'algo' => env('JWT_ALGO', 'HS256'),  // Encryption algorithm
    'required_claims' => [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti'
    ],
    'persistent_claims' => [],
    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),
    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 0),
    'show_black_list_exception' => env('JWT_SHOW_BLACKLIST_EXCEPTION', true),
];