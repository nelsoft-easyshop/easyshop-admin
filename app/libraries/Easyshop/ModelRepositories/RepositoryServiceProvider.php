<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\ServiceProvider;

/**
 * Register Model Repositories with Laravel
 */
class RepositoryServiceProvider extends ServiceProvider 
{
    /**
     * Registers the repositories with Laravel's IoC Container
     * 
     */
    public function register()
    {
        $this->app->bind('OrderRepository', function($app){   
            return new OrderRepository();
        });
        $this->app->bind('OrderProductRepository', function($app){   
            return new OrderProductRepository();
        });
        $this->app->bind('ProductRepository', function($app){   
            return new ProductRepository();
        });
        $this->app->bind('AdminMemberRepository', function($app){   
            return new AdminMemberRepository();
        });

    }

    
}


