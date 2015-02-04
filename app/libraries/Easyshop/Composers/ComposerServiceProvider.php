<?php namespace Easyshop\Composers;
 
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider 
{

   /**
    * Register a view composer to a particular view
    *
    */

    public function register()
    {
        $this->app->view->composer('includes.header', 'Easyshop\Composers\HeaderComposer');
        $this->app->view->composer('pages.paymentlist', 'Easyshop\Composers\PaymentComposer');
        $this->app->view->composer('pages.refundlist', 'Easyshop\Composers\RefundComposer');
        $this->app->view->composer('pages.transactionlist', 'Easyshop\Composers\TransactionComposer');
        $this->app->view->composer('partials.orderproductbilling', 'Easyshop\Composers\BillingDetailComposer');
        $this->app->view->composer('partials.orderproductlist', 'Easyshop\Composers\OrderProductListComposer');
        $this->app->view->composer('partials.orderdetail', 'Easyshop\Composers\OrderDetailComposer');
    }

}


