<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'blackbaud' => [
        'client_id' => '514f54d6-8a1b-453b-86c9-c7c73da42e6f',
        'client_secret' => 'nfCu6YvPcVWndG94zreCn8ULHF6IFLNnY4q6an+jDN8=',
        'redirect' => 'http://localhost:8000/auth/callback/blackbaud',
//        'Bb-Api-Subscription-Key' => 'd8b4e73f46384c589cc0159a5b97adbb',
    ],
];
