<?php

return [

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:3000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // You may specify: ['Content-Type', 'Authorization', ...]

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
