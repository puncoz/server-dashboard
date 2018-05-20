<?php

return [

    'uri'                        => 'server',
    'middleware'                 => 'web',
    'online_user_counter_margin' => 5 * 60,

    'db_tables' => [
        'users' => 'updated_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Server Dashboard Redis Connection
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Server Dashboard will store
    | the meta information required for it to function.
    |
    */

    'use' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Server Dashboard Redis Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix will be used when storing all Server Dashboard data in Redis.
    | You may modify the prefix when you are running multiple installations
    | of Server Dashboard on the same server so that they don't have problems.
    |
    */

    'prefix' => env('SERVER_DASHBOARD_PREFIX', 'server-dashboard:'),
];
