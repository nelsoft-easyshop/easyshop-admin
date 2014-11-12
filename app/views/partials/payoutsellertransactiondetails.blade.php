<div>
    <div class="table-responsive table-payment"> 
        <table class="table table-striped table-hover" id="order-tbl">
            <tr class='head'> 
                <td>Order Product Id</td> 
                <td>Product Name</td> 
                <td>Order Quantity</td> 
                <td>Shipping Fee</td>
                <td>Total Price</td>
                <td>Net Price</td>
                <td></td>
            </tr>
            @foreach($transactionDetails as $orderProduct)
                <tr>
                    <td>{{{ $orderProduct->id_order_product }}}</td>
                    <td>{{{ $orderProduct->product->name }}}</td>
                    <td>{{{ $orderProduct->order_quantity }}}</td>
                    <td>PHP {{{ number_format($orderProduct->handling_fee, 2, '.', '') }}}</td>
                    <td>PHP {{{ number_format($orderProduct->total, 2, '.', '') }}}</td>
                    <td>PHP {{{ number_format($orderProduct->net, 2, '.', '') }}}</td>
                    <td>
                        @if($orderProduct->shipping != 0)
                        <span class="org_btn view checkShipping" data-order-product-id="{{{ $orderProduct->id_order_product }}}" > View Shipping Details</span>
                        @else
                        <div id="divSpan{{{ $orderProduct->id_order_product }}}">
                            <span class="label label-danger "> NO SHIPPING DETAILS</span>
                            <span class="org_btn view addShipping" data-order-product-id="{{{ $orderProduct->id_order_product }}}" > ADD</span>
                        </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div>
        Mark as:
        <select id="tagType">
            <option value="0">--Select Tag--</option>
        @foreach($tags as $tag) 
            <option value="{{{ $tag->id_tag_type }}}" data-color="{{{ $tag->tag_color }}}" {{{ ($tag->id_tag_type === $currentStatus) ? "selected" : "" }}} >
                {{{ $tag->tag_description }}}
            </option> 
        @endforeach
        </select>

        @if($requestForRefund)
            <label class="label label-danger">
                Suggested for refund
            </label>
        @endif
    </div>
</div>