<?php

namespace Puncoz\ServerDashboard;

use Illuminate\Support\ServiceProvider;

/**
 * Class ServerDashboardServiceProvider
 * @package Puncoz\ServerDashboard
 */
class ServerDashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
