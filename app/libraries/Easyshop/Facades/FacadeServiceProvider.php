<?php namespace Easyshop\Facades;
    
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider 
{
    public function register() 
    {
        $this->app->bind('NumberFormatterAlias', function(){
            return new \Easyshop\Services\NumberFormatterService();
        });

        $this->app->bind('StringHelperAlias', function(){
            return new \Easyshop\Services\StringHelperService();
        });
    }
}