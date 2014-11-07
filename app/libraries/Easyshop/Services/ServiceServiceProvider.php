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

        $this->app->bind('ExcelService', function($app){
            return new ExcelService();

        });

        $this->app->bind('TransactionService', function($app){
            return new TransactionService(
                new \Easyshop\ModelRepositories\OrderProductStatusRepository,
                new \Easyshop\ModelRepositories\OrderBillingInfoRepository,
                new \Easyshop\ModelRepositories\OrderProductRepository,
                new \Easyshop\ModelRepositories\OrderProductHistoryRepository,
                new \Easyshop\ModelRepositories\OrderRepository,
                new \Easyshop\ModelRepositories\OrderStatusRepository,
                new \Easyshop\ModelRepositories\OrderHistoryRepository,
                new \Easyshop\ModelRepositories\PaymentMethodRepository,
                new \Easyshop\ModelRepositories\BankInfoRepository
            );
        });

        $this->app->bind('EmailService', function(){
            return new EmailService();
        });

        $this->app->bind('NumberFormatter', function(){
            return new NumberFormatterService();
        });

        $this->app->bind('StringHelperService', function(){
            return new StringHelperService();
        });

        $this->app->bind('XMLContentGetterService', function(){
            return new XMLContentGetterService();
        });

        $this->app->bind('AdminMemberManagerService', function(){
            return new AdminMemberManagerService();
        });

        $this->app->bind('RaffleManagerService', function(){
            return new RaffleManagerService();
        });        

        $this->app->bind('MessagesService', function(){
            return new MessagesService();
        });      

        $this->app->bind('ProductCSVService', function(){
            return new ProductCSVService();
        });

        $this->app->bind('CustomPaginator', function(){
            return new CustomPaginator();
        });                

        $this->app->bind('PayoutService', function(){
            return new PayoutService( 
                new \Easyshop\ModelRepositories\TagTypeRepository,
                new \Easyshop\ModelRepositories\OrderProductTagRepository,
                new \Easyshop\ModelRepositories\OrderProductRepository,
                new \Easyshop\ModelRepositories\ProductShippingCommentRepository,
                new \Easyshop\ModelRepositories\OrderProductStatusRepository,
                new \Easyshop\ModelRepositories\OrderStatusRepository,
                new \Easyshop\ModelRepositories\OrderProductHistoryRepository,
                new \Easyshop\ModelRepositories\OrderProductTagHistoryRepository,
                \App::make('TransactionService')
            );
        });

    }
}

