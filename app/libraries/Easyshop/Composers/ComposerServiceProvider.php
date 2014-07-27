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
	}
 
}