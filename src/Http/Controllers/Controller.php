<?php

namespace Puncoz\ServerDashboard\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Puncoz\ServerDashboard\Http\Middleware\Authenticate;
use Puncoz\ServerDashboard\Traits\JsonResponse;

/**
 * Class Controller
 * @package Puncoz\ServerDashboard\Http\Controllers
 */
class Controller extends BaseController
{
    use JsonResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    /**
     * @param string $error
     * @param int    $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorJsonResponse(string $error = 'error', int $code = 500)
    {
        return response()->json($this->makeError($error), $code);
    }

    /**
     * @param array  $result
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(array $result = [], string $message = 'success')
    {
        return response()->json($this->makeResponse($message, $result), 200);
    }
}
