<div class = "order-detail-container" >

    <input type='hidden' value='{{{ $order->id_order }}}' id='order-id'/>
    <input type='hidden' value='{{{ $order->transaction_id }}}' id='transaction-id'/>
    
    <div class='row'>
        <div class='col-md-6 order-info'>
            <div>
                <label>Invoice No:</label> 
                <span>
                    {{{ $order->invoice_no }}}
                </span>
            </div>
            
            <div>
                <label>Transaction ID:</label> 
                <span>
                    {{{ $order->transaction_id }}}
                </span>
            </div>
            
             <div>
                <label>Buyer:</label>
                <span>
                    {{{ $order->buyer->getStoreName() }}}
                </span>
            </div>
            
            <div>
                <label>Status:</label> 
                <span>
                    {{{ $order->orderStatus->name }}}
                </span>
            </div>
            
            <div>
                <label>Date of Transaction:</label>
                <span>
                    {{{ $order->dateadded }}}
                </span>
            </div>

            
        </div>

 
        <div class='col-md-6 amt-breakdown'>
            <div class='col-md-6'>
                <span>Total Amount</span>
            </div>
             <div class='col-md-6'>
                PHP {{ number_format($order->total,2,'.',',') }}
            </div>
            
            <div class='col-md-6'>
                <span>Easyshop Charge</span>
            </div>
             <div class='col-md-6 text-right'>
                - PHP {{ number_format($order->easyshop_charge,2,'.',',') }}
            </div>
            
            <div class='col-md-6'>
                <span>Payment Method Charge</span>
            </div>
            <div class='col-md-6 text-right'>
                - PHP {{ number_format($order->payment_method_charge,2,'.',',') }}
            </div>
         
            <div class='clear'></div>
            <div class='border-top'></div>
         
            
            <div class='col-md-6'>
                <span><b>Net</b></span>
            </div>
            <div class='col-md-6'>
               <b> PHP {{ number_format($order->net,2,'.',',') }} </b>
            </div>
            
        </div>

    </div>
    <div class='clear'></div>
    
    <br/>
    
    <div class="table-responsive table-payment"> 
        <table class="table table-striped table-hover" id="order-product-tbl">
            <tr class='head'>
                <td>Order Product ID</td>
                <td>Name</td>
                <td>Seller</td>
                <td>Order Quantity</td>
                <td>Unit Price</td>
                <td>Shipping fee</td>
                <td>Total Amount</td>
                <td>Net</td>
                <td>Status</td>
                <td></td>
                <td></td>
            </tr>
            @foreach($orderproducts as $orderProduct)
                <tr>
                    <td>{{{ $orderProduct->id_order_product }}}</td>
                    <td>{{{ $orderProduct->product->name }}}</td>
                    <td>{{{ $orderProduct->seller->getStoreName() }}}</td>
                    <td>{{{ $orderProduct->order_quantity }}}</td>
                    <td>PHP {{{ number_format($orderProduct->price,2,'.',',') }}}</td>
                    <td>PHP {{{ number_format($orderProduct->handling_fee,2,'.',',') }}}</td>
                    <td>PHP {{{ number_format($orderProduct->total,2,'.',',') }}}</td>
                    <td>PHP {{{ number_format($orderProduct->net,2,'.',',') }}}</td>
                    <td>{{{ $orderProduct->orderProductStatus->name }}}</td>
                    <td data-order-product-id='{{{ $orderProduct->id_order_product }}}'>
                        <span class="org_btn view"> View </span>
                    </td>
                    <td data-order-product-id='{{{ $orderProduct->id_order_product }}}'>
                        @if($orderProduct->voidable)
                            <span class="glyphicon glyphicon-remove op-void"></span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <div class='text-center'>
        @if($isOrderVoidable)
            <button id='o-void' class="btn btn-warning">
                <span class="glyphicon glyphicon-tag"></span> Void Transaction
            </button>
        @endif
    </div>
    
    <br/>
    <div class='void-message'>
    
    </div>
    
</div>