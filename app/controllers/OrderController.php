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
        $memberRepository = App::make('MemberRepository');
        return View::make('pages.paymentlist')->with('accountsToPay', $memberRepository->getUserAccountsToPay(Input::get('username'), Input::get('year'), Input::get('month'), Input::get('day') ))
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
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProducts = $orderProductRepository->getOrderProductByPaymentAccount($userdata['username'], $userdata['accountname'],$userdata['accountno']);      
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
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProduct = $orderProductRepository->getOrderProductById($userdata['order_product_id']);
      
        $html = View::make('partials.orderproducthistorylist')
                    ->with('orderproduct', $orderProduct)
                    ->render();
        return Response::json(array('html' => $html));
    }
    
    public function getOrderProductPaymentDetail(){
        $userdata = Input::get();
        $orderProductRepository = App::make('OrderProductRepository');
        
        $html = View::make('partials.orderproductbilling')
                    ->with('accounts', array())
                    ->render();
        return Response::json(array('html' => $html));
    }
    
    
}
