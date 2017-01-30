<?php

namespace Jkirkby91\LumenRestServerComponent\Providers;

use Illuminate\Support\ServiceProvider;
use Jkirkby91\IlluminateRequestPSR7Adapter\Middleware\PSR7AdapterMiddleware;

/**
 * Class RestServerServiceProvider
 *
 * @package Jkirkby91\LumenRestServerComponent
 * @author James Kirkby <jkirkby91@gmail.com>
 */
class LumenRestServerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServiceProviders();
        $this->registerRoutes();
        $this->registerControllers();
    }

    /**
     * Register any component service providers
     */
    public function registerServiceProviders()
    {
        $this->app->register(\Jkirkby91\IlluminateRequestPSR7Adapter\Providers\Psr7AdapterServiceProvider::class);
        $this->app->register(\Jkirkby91\LumenPSR7Cors\Providers\LumenCorsServiceProvider::class);
        $this->app->register(\Spatie\Fractal\FractalLumenServiceProvider::class);
    }

    /**
     *
     */
    public function registerRoutes()
    {
        include __DIR__.'/../Http/routes.php';
    }

    /**
     *Register any component controllers
     */
    public function registerControllers()
    {
        // Let Laravel Ioc Container know about our Controller
        $this->app->make('Jkirkby91\LumenRestServerComponent\Http\Controllers\PingController');
    }
}
