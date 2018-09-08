<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    // if (!isset($config['project_id'], $config['client_id'], $config['client_email'], $config['private_key'])) {

    'firebase' => [
        'project_id' => env('FIREBASE_PROJECT_ID'),
        'client_id' => env('FIREBASE_CLIENT_ID'),
        'api_key' => env('FIREBASE_API_KEY'), // Only used for JS integration
        'auth_domain' => env('FIREBASE_AUTH_DOMAIN'), // Only used for JS integration
        'database_url' => env('FIREBASE_DATABASE_URL'),
        'secret' => env('FIREBASE_DATABASE_SECRET'),
        'storage_bucket' => env('FIREBASE_STORAGE_BUCKET'), // Only used for JS integration
    ]
];
