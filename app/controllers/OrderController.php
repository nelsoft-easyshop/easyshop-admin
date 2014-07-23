<?PHP

use Easyshop\Services\Order\OrderService as OrderService;

class OrderController extends BaseController 
{
	protected $order;
	
	public function __construct(OrderService $order)
	{
		$this->order = $order;
	}
	
	/**
	*	Sample function to test that the order service is accesible
	*
	*/
	
	public function getUsersToPay()
	{	
		var_dump($this->order->getOrder(1));
	    exit();
	}
	
	
}
