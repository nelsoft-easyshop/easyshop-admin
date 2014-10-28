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

        $this->app->bind('ProductRepository', function($app){   
            return new ProductRepository();
        });

        $this->app->bind('AdminMemberRepository', function($app){   
            return new AdminMemberRepository();
        });

        $this->app->bind('RegisterAdminRepository', function($app){   
            return new RegisterAdminRepository();
        });        

        $this->app->bind('LocationLookUpRepository', function($app){
            return new LocationLookUpRepository();
        });

        $this->app->bind('AddressRepository', function($app){
            return new AddressRepository();
        });

        $this->app->bind('ProductRepository', function($app){
            return new ProductRepository();
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

        $this->app->bind('CategoryRepository', function($app){
            return new CategoryRepository();
        });
        
        $this->app->bind('OrderBillingInfoRepository', function($app){  
            return new OrderBillingInfoRepository();
        });

        $this->app->bind('OrderHistoryRepository', function($app){
            return new OrderHistoryRepository();
        });
        
        $this->app->bind('PaymentMethodRepository', function($app){  
            return new PaymentMethodRepository();
        });
   
        $this->app->bind('RaffleRepository', function($app){  
            return new RaffleRepository();
        });     
        
        $this->app->bind('SearchKeyWordsRepository', function($app){  
            return new SearchKeyWordsRepository();
        });      

        $this->app->bind('MessagesRepository', function($app){  
            return new MessagesRepository();
        });   

        $this->app->bind('AdminImagesRepository', function($app){  
            return new AdminImagesRepository();
        }); 

        $this->app->bind('BrandRepository', function($app){  
            return new BrandRepository();
        });

        $this->app->bind('TagTypeRepository', function($app){  
            return new TagTypeRepository();
        });
    }
}
