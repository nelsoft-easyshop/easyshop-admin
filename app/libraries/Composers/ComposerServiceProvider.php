<?php namespace Composers;
 
use Illuminate\Support\ServiceProvider;
 
class ComposerServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->view->composer('includes.header', 'Composers\HeaderComposer');
  }
 
}