<?php

	namespace Jkirkby91\LumenRestServerComponent\Providers {

		use Illuminate\Support\ServiceProvider;
		use Jkirkby91\IlluminateRequestPSR7Adapter\Middleware\PSR7AdapterMiddleware;
		use Jkirkby91\LumenRestServerComponent\Http\Requests\ValidateRequestFactory;

		/**
		 * Class LumenRestServerServiceProvider
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Providers
		 * @author  James Kirkby <jkirkby@protonmail.ch>
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
			 * Register Middleware
			 */
			public function registerMiddleware()
			{
				$this->app->routeMiddleware(['validateRequest' => \Jkirkby91\LumenRestServerComponent\Http\Middleware\ValidateRequestMiddleware::class]);
			}

			/**
			 * Register Routes
			 */
			public function registerRoutes()
			{
				include __DIR__.'/../Http/routes.php';
			}
		}
	}
