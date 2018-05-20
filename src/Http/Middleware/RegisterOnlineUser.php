<?php

namespace Puncoz\ServerDashboard\Http\Middleware;

use Closure;
use Puncoz\ServerDashboard\Services\OnlineCounter;

/**
 * Class RegisterOnlineUser
 * @package Puncoz\ServerDashboard\Http\Middleware
 */
class RegisterOnlineUser
{
    protected $sessionKeyPrefix;
    /**
     * @var OnlineCounter
     */
    protected $onlineCounter;

    /**
     * RegisterOnlineUser constructor.
     *
     * @param OnlineCounter $onlineCounter
     */
    public function __construct(
        OnlineCounter $onlineCounter
    ) {
        $this->sessionKeyPrefix = lrtrim(config('server-dashboard.prefix'), ':');
        $this->onlineCounter    = $onlineCounter;
    }

    /**
     * @param         $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->registerUser();

        return $next($request);
    }

    /**
     * Register user with unique key
     */
    protected function registerUser()
    {
        $onlineSessionCode = $this->getSessionCode();

        if ( auth()->guest() ) {
            $this->onlineCounter->logGuestUser($onlineSessionCode);

            return;
        }

        $this->onlineCounter->logAuthenticUser($onlineSessionCode);

        return;
    }

    /**
     * @return string
     */
    protected function getSessionCode(): string
    {
        $sessionKey = $this->getSessionKey();

        if ( session()->has($sessionKey) && !is_null(session()->get($sessionKey)) ) {
            return session()->get($sessionKey);
        }

        $code = $this->generateUniqueKey();
        session()->put($sessionKey, $code);

        return $code;
    }

    /**
     * @return string
     */
    private function getSessionKey(): string
    {
        return sprintf("%s:online-user", $this->sessionKeyPrefix);
    }

    /**
     * @return string
     */
    private function generateUniqueKey(): string
    {
        return md5(uniqid());
    }
}
