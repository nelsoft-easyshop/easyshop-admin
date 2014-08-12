<?php namespace Easyshop\Composers;


class OrderProductListComposer 
{
   /**
    *    Inject parameters in $view everytime the view is loaded
    *
    *    @param View $view
    */
    public function compose($view)
    {
        $viewData = $view->getData();

        $paidStatus = $viewData['completedStatus'];
        
        $isPaid = true;
        foreach($viewData['orderproducts'] as $orderProduct){
            if(intval($orderProduct->status) !== $paidStatus){
                $isPaid = false;
            }
        }
        

        $view->with('isPaid',  $isPaid);
    }
}