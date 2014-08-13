<?php namespace Easyshop\Services;

use Illuminate\Support\ServiceProvider;

/**
 * Register our easyshop services with Laravel
 */
class ServiceServiceProvider extends ServiceProvider 
{
    /**
     * Registers the service in the IoC Container
     * 
     */
    public function register()
    {
        $this->app->bind('LocationService', function($app){
            return new LocationService();
        });

        $this->app->bind('TransactionService', function($app){
            return new TransactionService();
        });

        $this->app->bind('NumberFormatter', function(){
            return new NumberFormatterService();
        });
        
    }
}

