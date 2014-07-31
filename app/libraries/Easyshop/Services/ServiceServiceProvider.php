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
        $this->app->bind('DataFormatterService', function($app){
            return new DataFormatterService();
        });
    }
}
