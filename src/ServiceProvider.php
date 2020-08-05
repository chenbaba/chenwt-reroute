<?php

namespace Chenwt\Reroute;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Session\SessionManager;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/reroute.php';
        $this->mergeConfigFrom($configPath, 'reroute');
        $routeFile = __DIR__ . '/tmp/UriValidator.php';
        $this->publishes([
            $configPath => config_path('reroute.php'),
            app_path('vendor/laravel/framework/src/Illuminate/Routing/Matching/UriValidator.php')=>__DIR__ . '/tmp/UriValidator_bak.php',
            $routeFile => app_path('vendor/laravel/framework/src/Illuminate/Routing/Matching/UriValidator.php')
        ]);
    }

}
