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

    'sendgrid' => [
        'api_key' => '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',
    ],





    'mailgun' => [
        'domain' =>env('MAILGUN_DOMAIN'),
        'secret' =>env('MAILGUN_SECRET'),
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

    'nexmo' => [
        'key' => '07f43500',
    'secret' => 'Wb8LmO6Q81um618U',
        'sms_from' => '+964 772 771 0118',
    ],

    'facebook' => [
        'client_id' =>'408093733621860',
        'client_secret' =>'65bc75b939eb35439ae526b6356a28522',
        'redirect' =>'https://intense-reaches-85730.herokuapp.com/auth/google/callback',
    ],
];
