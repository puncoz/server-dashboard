<?php

namespace Puncoz\ServerDashboard;

use Closure;
use Exception;

/**
 * Class ServerDashboard
 * @package Puncoz\ServerDashboard
 */
class ServerDashboard
{
    /**
     * The callback that should be used to authenticate users.
     *
     * @var Closure
     */
    protected static $authUsing;

    /**
     * Determine if the given request can access the Server dashboard.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public static function check($request): bool
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })(
            $request
        );
    }

    /**
     * Configure the Redis databases that will store Server Dashboard data.
     *
     * @param  string $connection
     *
     * @return void
     * @throws Exception
     */
    public static function use($connection)
    {
        if ( is_null($config = config("database.redis.{$connection}")) ) {
            throw new Exception("Redis connection [{$connection}] has not been configured.");
        }

        config(
            [
                'database.redis.server-dashboard' => array_merge(
                    $config,
                    [
                        'options' => [
                            'prefix' => config('server-dashboard.prefix') ?: 'server-dashboard:',
                        ],
                    ]
                ),
            ]
        );
    }
}
