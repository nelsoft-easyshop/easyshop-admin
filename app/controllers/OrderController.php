<?PHP


class OrderController extends BaseController 
{

    /**
     *  Sample function to test that the order service is accesible
     *
     */
    public function getUsersToPay()
    {
        $userdata = Input::get();
        $orderProductEntity = App::make('OrderProductRepository');
        return View::make('pages.paymentlist')->with('accountsToPay', $orderProductEntity->getUserAccountsToPay($userdata))
                    ->with('input', Input::all());
    }


}
