<?php

namespace Puncoz\ServerDashboard\Http\Controllers;

/**
 * Class HomeController
 * @package Puncoz\ServerDashboard\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Single page application catch-all route.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('server-dashboard::app');
    }
}
