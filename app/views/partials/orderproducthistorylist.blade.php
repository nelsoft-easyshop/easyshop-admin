<div class="table-responsive table-payment"> 
    <table class="table table-striped table-hover">
        <tr class='head'>
            <td>Order Product ID</td>
            <td>Invoice No</td>
            <td>Buyer ID</td>
            <td>Username</td>
            <td>Product ID</td>
            <td>Product Name</td>
            <td>Unit Price</td>
            <td>Order Quantity</td>
            <td>Easyshop Charge</td>     
            <td>Payment Method Charge</td>
            <td>Net</td>
            <td>Status</td>
        </tr>    

        <tr>
            
            <td>{{{ $orderproduct->id_order_product }}}</td>
            <td>{{{ $orderproduct->order->invoice_no }}}</td>
            <td>{{{ $orderproduct->order->buyer_id }}}</td>
            <td>{{{ $orderproduct->order->buyer->username }}}</td>
            <td>{{{ $orderproduct->product_id }}}</td>
            <td>{{{ $orderproduct->product->name }}}</td>
            <td>{{ number_format($orderproduct->price,2,'.',',') }}</td>
            <td>{{{ $orderproduct->order_quantity }}}</td>    
            <td>{{ number_format($orderproduct->easyshop_charge,2,'.',',') }}</td>
            <td>{{ number_format($orderproduct->payment_method_charge,2,'.',',') }}</td>
            <td>{{ number_format($orderproduct->net,2,'.',',') }}</td>
            <td>{{{ $orderproduct->orderProductStatus->name }}}</td>    
            
        </tr>   
       
    </table>
    
    <br/><br/>

        
    @if(count($orderproduct->orderProductHistory) > 0)
        <table class="table table-striped table-hover">
        <tr class='head'>
            <td>History ID</td>
            <td>State</td>
            <td>Date</td>

        </tr>    
        @foreach($orderproduct->orderProductHistory as $history)
        <tr>
            
            <td>{{{ $history->id_order_product_history}}}</td>
            <td>{{{ $history->orderProductStatus->name }}}</td>
            <td>{{{ $history->created_at }}}</td>

            
        </tr>   
        @endforeach
    
        </table>
    @endif
    
    @if($orderproduct->orderProductComment)
        <h6>* Shipped on {{{ $orderproduct->orderProductComment->delivery_date }}}.</h6>
    @endif
    </div>
    
</div>