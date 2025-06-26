<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Passport Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify which authentication guard Passport will use when
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your auth configuration file.
    |
    */

    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Passport Password Grant Client
    |--------------------------------------------------------------------------
    |
    | Here you may specify the password grant client ID and secret. This is
    | used when issuing access tokens via the password grant.
    |
    */

    'password_client' => [
        'id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
        'secret' => env('PASSPORT_PASSWORD_CLIENT_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Passport Personal Access Client
    |--------------------------------------------------------------------------
    |
    | Here you may specify the personal access client ID and secret. This is
    | used when issuing personal access tokens.
    |
    */

    'personal_access_client' => [
        'id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
    ],
];
