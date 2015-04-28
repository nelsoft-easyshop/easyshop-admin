<div class="order-product-account-container">
    @if(isset($accountname))
       <label> Account Name: </label> <input type="text" class="form-control accountname" value="{{{ $accountname }}}" readonly/>  
    @endif
    
    @if(isset($accountno))
       <label> Account Number:  </label>   <input type="text" class="form-control accountno" value="{{{ $accountno }}}" readonly/>  
    @endif
    
    @if(isset($bankname))
        <label> Bank Name:  </label>  <input type="text" class="form-control bankname" value="{{{ $bankname }}}" readonly/> 
    @endif 
    

</div>


<div class="table-responsive table-payment"> 
    <table class="table table-striped table-hover">
        <tr class='head'>
            @if(@isset($isRefund) && $isRefund)
                <td>Refund</td>
            @endif
            <td>Order ID</td>
            <td>Invoice No</td>
            <td>{{{ $memberTitle or 'Member' }}} ID</td>
            <td>User</td>
            <td>Product ID</td>
            <td>Product Name</td>
            <td>Order Quantity</td>     
            <td>Unit Price</td>
            <td>Total Amount</td>
            <td>Easyoint</td>
            <td>NET</td>        
            <td>Status</td>
            <td>&nbsp;</td>
        </tr>    

         
        @foreach($orderproducts as $orderproduct)
        <tr class="order_product" data-orderproductid = "{{{ $orderproduct->id_order_product }}}">                       
            @if(@isset($isRefund) && $isRefund)
            <td>
                @if($orderproduct->order_product_status_id == OrderProductStatus::STATUS_RETURN_BUYER)
                     <input type="checkbox" class="refund-order-product-id" checked/>
                @else
                     <span class="green_btn"> REFUNDED </span>
                @endif
            </td>
            @endif
            <td>{{{ $orderproduct->order_id }}}</td>
            <td>{{{ $orderproduct->invoice_no }}}</td>
            <td>{{{ $orderproduct->buyer_seller_id }}}</td>
            <td>{{{ $orderproduct->buyer_seller_storename }}}</td>
            <td>{{{ $orderproduct->product_id }}}</td>
            <td>{{{ $orderproduct->productname }}}</td>
            <td>{{{ $orderproduct->order_quantity }}}</td>        
            <td>{{ number_format($orderproduct->price,2,'.',',') }}</td>
            <td>{{ number_format($orderproduct->total,2,'.',',') }}</td>
            <td>{{ number_format($orderproduct->easypoint,2,'.',',') }}</td>
            @if(bccomp($orderproduct->easypoint,0) === 1)
                <td class="net">{{ number_format(bcsub($orderproduct->net, $orderproduct->easypoint, 4),2,'.',',') }}</td>  
            @else
                <td class="net">{{ number_format($orderproduct->net,2,'.',',') }}</td>  
            @endif

            <td>{{{ $orderproduct->statusname}}}</td>
            <td>
                <span class="org_btn view"> View </span>&nbsp;
            </td>
            <td class="hide order-product-id"> {{{$orderproduct->id_order_product }}} </td>

        </tr>   
        @endforeach           
    </table>
    
    @if(!$isPaid)
            <button class="btn center-block op-pay-btn {{{ strtolower($memberTitle) }}}">Proceed with Payment</button>
    @endif
    

</div>