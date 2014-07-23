<?php namespace Easyshop\Services\Order;

use Illuminate\Support\ServiceProvider;

/**
* Register our Order service with Laravel
*/
class OrderServiceServiceProvider extends ServiceProvider 
{
    /**
    * Registers the service in the IoC Container
    * 
    */
    public function register()
    {
        // Binds 'OrderService' to the result of the closure
        $this->app->bind('OrderService', function($app)
        {	
            return new OrderService(
                // Inject in the orderInterface class, this will be our repository
                $app->make('Easyshop\Repositories\Order\OrderInterface')
            );
        });
    }
}