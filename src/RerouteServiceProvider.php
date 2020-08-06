<?php

namespace Chenwt\Reroute;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Session\SessionManager;

class RerouteServiceProvider extends \Illuminate\Support\ServiceProvider
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

    }

    public function register()
    {
        $lockFile = __DIR__ . '/re.lock';
        if (is_file($lockFile)) {
            return false;
        }
        $configPath = __DIR__ . '/../config/reroute.php';
        $this->mergeConfigFrom($configPath, 'reroute');
        $routeFile = __DIR__ . '/tmp/UriValidator.php';
        if (is_file(dirname(app_path()) . ('/vendor/laravel/framework/src/Illuminate/Routing/Matching/UriValidator.php')))
        {
            copy(dirname(app_path()) . ('/vendor/laravel/framework/src/Illuminate/Routing/Matching/UriValidator.php') , __DIR__ . '/tmp/UriValidator_bak.php');
            unlink(dirname(app_path()) . ('/vendor/laravel/framework/src/Illuminate/Routing/Matching/UriValidator.php'));
        }
        $this->publishes([
            $configPath => config_path('reroute.php'),
            dirname(app_path()) . ('/vendor/laravel/framework/src/Illuminate/Routing/Matching/UriValidator.php')=>__DIR__ . '/tmp/UriValidator_bak.php',
            $routeFile => dirname(app_path()) . ('/vendor/laravel/framework/src/Illuminate/Routing/Matching/UriValidator.php')
        ]);
        file_put_contents(__DIR__ . '/re.lock',1);
    }

}
