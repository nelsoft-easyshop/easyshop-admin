<?php namespace Easyshop\Composers;

use Easyshop\ModelRepositories\OrderProductStatusRepository as OrderProductStatusRepository;
use Easyshop\ModelRepositories\OrderStatusRepository as OrderStatusRepository;

class OrderDetailComposer
{

    /**
     * OrderProductStatus Repository
     *
     * @var OrderProductStatusRepository
     */
    private $orderProductStatusRepository;


    
    public function __construct(OrderProductStatusRepository $orderProductStatusRepository)
    {
        $this->orderProductStatusRepository = $orderProductStatusRepository;
    }

    /**
     *    Inject parameters in $view everytime the view is loaded
     *
     *    @param View $view
     */
    public function compose($view)
    {
        $viewData = $view->getData();
        $isOrderVoidable = false;
        foreach($viewData['orderproducts'] as $idx => $orderProduct){
            if(intval($orderProduct->status) ===  intval($this->orderProductStatusRepository->getOnGoingStatus())){
                $viewData['orderproducts'][$idx]['voidable'] = true; 
                $isOrderVoidable = true;
            }
            else{
                $viewData['orderproducts'][$idx]['voidable'] = false; 
            }
        }
        
        $view->with('orderproducts',  $viewData['orderproducts'])
            ->with('isOrderVoidable', $isOrderVoidable);
    }
}
