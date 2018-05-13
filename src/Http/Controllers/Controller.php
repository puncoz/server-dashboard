<?php

namespace Puncoz\ServerDashboard\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Puncoz\ServerDashboard\Http\Middleware\Authenticate;

/**
 * Class Controller
 * @package Puncoz\ServerDashboard\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }
}
