<div class="table-responsive table-payment"> 
    <table class="table table-striped table-hover">
        <tr class='head'>
            <td>Order ID</td>
            <td>Invoice No</td>
            <td>Buyer ID</td>
            <td>Username</td>
            <td>Product ID</td>
            <td>Product Name</td>
            <td>Order Quantity</td>     
            <td>Unit Price</td>
            <td>Total Amount</td>
            <td>NET</td>        
            <td>Status</td>
            <td>&nbsp;</td>
        </tr>    
        @foreach($orderproducts as $orderproduct)
        <tr class="order_product" data-orderproductid = "{{{ $orderproduct->id_order_product }}}">
            
            <td>{{{ $orderproduct->order_id }}}</td>
            <td>{{{ $orderproduct->invoice_no }}}</td>
            <td>{{{ $orderproduct->buyer_id }}}</td>
            <td>{{{ $orderproduct->buyer }}}</td>
            <td>{{{ $orderproduct->product_id }}}</td>
            <td>{{{ $orderproduct->productname }}}</td>
            <td>{{{ $orderproduct->order_quantity }}}</td>        
            <td>{{ number_format($orderproduct->price,2,'.',',') }}</td>
            <td>{{ number_format($orderproduct->total,2,'.',',') }}</td>
            <td class="net">{{ number_format($orderproduct->net,2,'.',',') }}</td>     
            <td>{{{ $orderproduct->statusname}}}</td>
            
            <td>
                <span class="org_btn view"> View </span>&nbsp;
                @if($orderproduct->status != 4)
                    <span class="org_btn pay"> Pay </span>&nbsp;
                @endif
            </td>
          

        </tr>   
        @endforeach           
    </table>
</div>