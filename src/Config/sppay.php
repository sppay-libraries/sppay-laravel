<?php

return [
    'base_url' => env('SPPAY_BASE_URL', 'https://engine.sppay.dev'),
    'grant_type' => env('AUTH_CLIENT_GRANT_TYPE', 'password'),
    'client_id' => env('AUTH_CLIENT_ID'),
    'client_secret' => env('AUTH_CLIENT_SECRET'),
    'username' => env('AUTH_CLIENT_USERNAME'),
    'password' => env('AUTH_CLIENT_PASSWORD'),
];
