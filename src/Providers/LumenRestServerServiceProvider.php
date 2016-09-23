<?php

namespace Jkirkby91\LumenRestServerComponent\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
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
        $this->bindContractImplementations();
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
    }

    /**
     * Register any component service providers
     */
    public function registerServiceProviders()
    {
        $this->app->register(\Spatie\Fractal\FractalLumenServiceProvider::class);
    }

    /**
     * Bind our lumen implementations to our expected contracts
     */
    public function bindContractImplementations()
    {
        $this->app->bind('Psr\Http\Message\ServerRequestInterface', function ($app) {
            return (new DiactorosFactory)->createRequest($this->app->make('request'));
        });

//        $this->app->bind(
//            'Psr\Http\Message\ServerRequestInterface',
//            'Zend\Diactoros\ServerRequest'
//        );
//
//        $this->app->bind(
//            'Psr\Http\Message\ResponseInterface',
//            'Zend\Diactoros\Response'
//        );
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
        $this->app->middleware(PSR7AdapterMiddleware::class);
    }

    /**
     *Register any component controllers
     */
    public function registerControllers()
    {
        // Let Laravel Ioc Container know about our Controller
//        $this->app->make('Jkirkby91\RestServer\Http\Controllers\PingController');
    }

}