<?php

namespace Puncoz\ServerDashboard;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class ServerDashboardServiceProvider
 * @package Puncoz\ServerDashboard
 */
class ServerDashboardServiceProvider extends ServiceProvider
{
    use RepositoryBindings;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerHelpers();
        $this->registerRoutes();
        $this->registerResources();
        $this->defineAssetPublishing();
    }

    /**
     * Register services.
     *
     * @return void
     * @throws \Exception
     */
    public function register()
    {
        $this->configure();
        $this->offerPublishing();
        $this->registerRepositories();
    }

    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    public function defineAssetPublishing()
    {
        $this->publishes(
            [
                __DIR__.'/../public' => public_path('vendor/server-dashboard'),
            ],
            'server-dashboard-assets'
        );
    }

    /**
     * Register the Server Dashboard routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group(
            [
                'prefix'     => config('server-dashboard.uri', 'server'),
                'namespace'  => 'Puncoz\ServerDashboard\Http\Controllers',
                'middleware' => config('server-dashboard.middleware', 'web'),
                'as'         => 'server-dashboard.',
            ],
            function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            }
        );
    }

    /**
     * Register the Server Dashboard resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'server-dashboard');
    }

    /**
     * Setup the configuration for Server Dashboard.
     *
     * @return void
     * @throws \Exception
     */
    protected function configure()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/server-dashboard.php', 'server-dashboard');

        ServerDashboard::use(config('server-dashboard.use'));
    }

    /**
     * Setup the resource publishing groups for Server Dashboard.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ( $this->app->runningInConsole() ) {
            $this->publishes(
                [
                    __DIR__.'/../config/server-dashboard.php' => config_path('server-dashboard.php'),
                ],
                'server-dashboard-config'
            );
        }
    }

    /**
     * Register helpers file
     */
    protected function registerHelpers()
    {
        require __DIR__.'/Helper/helpers.php';
    }

    /**
     * Register Server Dashboard's repositories in the container.
     *
     * @return void
     */
    protected function registerRepositories()
    {
        collect($this->repositoryBindings)->each(
            function ($concrete, $contract) {
                $this->app->singleton($contract, $concrete);
            }
        );
    }
}
