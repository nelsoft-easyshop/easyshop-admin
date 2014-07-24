<?PHP


class OrderController extends BaseController 
{

    /**
     *  Sample function to test that the order service is accesible
     *
     */
    public function getUsersToPay()
    {
        $orderEntity = App::make('OrderRepository');
        return View::make('pages.paymentlist')->with('order', $orderEntity->getOrderById(1));
    }


}
