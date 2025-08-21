<?php

return [
    'application_id' => env('SQUARE_APPLICATION_ID'),
    'access_token' => env('SQUARE_ACCESS_TOKEN'),
    'environment' => env('SQUARE_ENVIRONMENT', 'sandbox'),
    'webhook_signature_key' => env('SQUARE_WEBHOOK_SIGNATURE_KEY'),
    'location_id' => env('SQUARE_LOCATION_ID'),
];