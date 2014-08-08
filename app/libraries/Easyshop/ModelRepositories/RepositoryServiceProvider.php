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
        $this->app->bind('OrderProductHistoryRepository', function($app){   
            return new OrderProductHistoryRepository();
        });
        
        $this->app->bind('OrderProductStatusRepository', function($app){   
            return new OrderProductStatusRepository();
        });
        
        $this->app->bind('OrderStatusRepository', function($app){   
            return new OrderStatusRepository();
        });
    
        $this->app->bind('OrderRepository', function($app){   
            return new OrderRepository();
        });
        
        $this->app->bind('OrderProductRepository', function($app){  
            return new OrderProductRepository();
        });
        
        $this->app->bind('BillingInfoRepository', function($app){  
            return new BillingInfoRepository();
        });
        
        $this->app->bind('MemberRepository', function($app){  
            return new MemberRepository(
                $app->make('TransactionService')
            );
        });
        
        $this->app->bind('BankInfoRepository', function($app){  
            return new BankInfoRepository();
        });
        
        $this->app->bind('OrderProductBillingInfoRepository', function($app){  
            return new OrderProductBillingInfoRepository();
        });
                      

    }

    
}


