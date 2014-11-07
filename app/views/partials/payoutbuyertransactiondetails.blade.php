<div>
    <div class="table-responsive table-payment"> 
        <span id="orderId" style="display:none;">{{$orderId}}</span>
        <table class="table table-striped table-hover" id="order-tbl">
            <tr class='head'> 
                <td>Order Product Id</td> 
                <td>Product Name</td> 
                <td>Order Quantity</td> 
                <td>Price</td> 
                <td></td> 
            </tr>
            @foreach($transactionDetails as $orderProduct)
                <tr>
                    <td class="orderProductId">{{{ $orderProduct->id_order_product }}}</td>
                    <td>{{{ $orderProduct->product->name }}}</td>
                    <td>{{{ $orderProduct->order_quantity }}}</td>
                    <td>PHP {{{ number_format($orderProduct->total, 2, '.', '') }}}</td>
                    <td>
                        <span class="org_btn view checkShipping" data-order-product-id="{{{ $orderProduct->id_order_product }}}" > View Shipping Details</span>
                    </td>                    
                </tr>
            @endforeach
        </table>

        <table>
            <div>
                Mark as: 
                <tr>
                <td><form id="form">
                    <select id="tagOption">
                        <option value="0">--Select Tag--</option>
                    @foreach($tags as $tag)
                        <option value="{{{ $tag->id_tag_type }}}" >{{{ $tag->tag_description }}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="sellerID" id="sellerID" value="{{{ $sellerId }}}">
                </form></td>
                <td> {{ ($suggestForPayOut) ?  "<span class='org_btn view'>Suggest For Payout</span>" : "" }}</td></tr>
            </div>
         </table>        
    </div>
</div>
