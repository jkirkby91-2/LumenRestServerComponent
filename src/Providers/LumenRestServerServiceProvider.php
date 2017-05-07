<?php

namespace Jkirkby91\LumenRestServerComponent\Providers;

use Illuminate\Support\ServiceProvider;
use Jkirkby91\IlluminateRequestPSR7Adapter\Middleware\PSR7AdapterMiddleware;
use Jkirkby91\LumenRestServerComponent\Http\Requests\ValidateRequestFactory;

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
      $this->app['validateRequestFactory'] = new ValidateRequestFactory;
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServiceProviders();
        $this->registerMiddleware();
        $this->registerRoutes();
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
     * Register middleware
     */
    public function registerMiddleware()
    {
      $this->app->routeMiddleware(['validateRequest' => \Jkirkby91\LumenRestServerComponent\Http\Middleware\ValidateRequestMiddleware::class]);
    }

    /**
     *
     */
    public function registerRoutes()
    {
        include __DIR__.'/../Http/routes.php';
    }
}
