<?php namespace Easyshop\Repositories\Order;

use Order;

use Easyshop\Repositories\Order\EloquentOrderRepository;
use Illuminate\Support\ServiceProvider;


/**
* Register our Repository with Laravel
*/
class OrderRepositoryServiceProvider extends ServiceProvider 
{
    /**
    * Registers the orderInterface with Laravels IoC Container
    * 
    */
    public function register()
    {
        // Bind the returned class to the namespace 'Easyshop\Repositories\OrderInterface
        $this->app->bind('Easyshop\Repositories\Order\OrderInterface', function($app)
        {
            return new EloquentOrderRepository(new Order());
        });
    }
}