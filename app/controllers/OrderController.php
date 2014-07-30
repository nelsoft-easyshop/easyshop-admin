<?PHP


class OrderController extends BaseController 
{

    /**
     *  GET method for displaying list of account to pay
     *
     *  @return View
     */
    public function getUsersToPay()
    {
        $userdata = Input::get();
        $orderProductEntity = App::make('OrderProductRepository');
        return View::make('pages.paymentlist')->with('accountsToPay', $orderProductEntity->getUserAccountsToPay($userdata))
                    ->with('input', Input::all());
    }

    
   /**
    *  GET method for displaying specific order products in a payment account
    *
    *  @return View
    */
    public function getOrderProducts()
    {
        $userdata = Input::get();
        $orderProductEntity = App::make('OrderProductRepository');
        $orderProducts = $orderProductEntity->getOrderProductByPaymentAccount($userdata['username'], $userdata['accountname'],$userdata['accountno']);      
        $html = View::make('partials.orderproductlist')
                    ->with('orderproducts', $orderProducts)
                    ->render();
        return Response::json(array('html' => $html));
    }

   /**
    *  GET method for displaying order product history
    *
    *  @return View
    */
    public function getOrderProductDetail()
    {
        $userdata = Input::get();
        $orderProductEntity = App::make('OrderProductRepository');
        $orderProduct = $orderProductEntity->getOrderProductById($userdata['order_product_id']);
      
        $html = View::make('partials.orderproducthistorylist')
                    ->with('orderproduct', $orderProduct)
                    ->render();
        return Response::json(array('html' => $html));
    }
    
    public function getOrderProductPaymentDetail(){
        $userdata = Input::get();
        $orderProductEntity = App::make('OrderProductRepository');
        
        $html = View::make('partials.orderproductbilling')
                    ->with('accounts', array())
                    ->render();
        return Response::json(array('html' => $html));
    }
    
    
}
