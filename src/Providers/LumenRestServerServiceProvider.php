<?php

namespace Jkirkby91\LumenRestServerComponent\Providers;

use Illuminate\Support\ServiceProvider;
//use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
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
        $this->registerConfigs();
        $this->registerServiceProviders();
        $this->registerRoutes();
        $this->registerComponentMiddlewares();
        $this->registerControllers();
    }

    /**
     * Register configs for this component and merge and vendor configs
     */
    public function registerConfigs()
    {
        //@TODO implement
//        $this->app->configure('cors');
    }

    /**
     * Register any component service providers
     */
    public function registerServiceProviders()
    {
//        $this->app->register(\Barryvdh\Cors\ServiceProvider::class);
//        $this->app->register(\Jkirkby91\LumenPSR7Cors\Providers\LumenCorsServiceProvider::class);
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
     * Register any component middlewares
     */
    public function registerComponentMiddlewares()
    {
//        $this->app->middleware(\Barryvdh\Cors\HandleCors::class);
//        $this->app->middleware(\Barryvdh\Cors\HandlePreflight::class);
        $this->app->middleware(PSR7AdapterMiddleware::class);
        $this->app->middleware(\Jkirkby91\LumenPSR7Cors\Http\Middleware\Cors::class);
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