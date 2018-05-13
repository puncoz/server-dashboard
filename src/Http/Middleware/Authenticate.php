<?php

namespace Puncoz\ServerDashboard\Http\Middleware;

use Puncoz\ServerDashboard\ServerDashboard;

/**
 * Class Authenticate
 * @package Puncoz\ServerDashboard\Http\Middleware
 */
class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return \Illuminate\Http\Response|null
     */
    public function handle($request, $next)
    {
        return ServerDashboard::check($request) ? $next($request) : abort(403);
    }
}
