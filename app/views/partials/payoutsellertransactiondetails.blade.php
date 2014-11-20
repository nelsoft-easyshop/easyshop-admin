<div>
    <div class="table-responsive table-payment"> 
        <table class="table table-striped table-hover" id="order-tbl">
            <tr class='head'> 
                <td></td>
                <td>Order Product Id</td> 
                <td>Product Name</td> 
                <td>Order Quantity</td> 
                <td>Shipping Fee</td>
                <td>Total Price</td>
                <td>Net Price</td>
                <td>Current Tag</td>
                <td></td>
            </tr>
            @foreach($transactionDetails as $orderProduct)
                <tr>
                    <td>
                    @if(!$isFilter || $isFilter == $contactedTag)
                    <input name="order-id-checkbox"
                               class="check-box-order-product" 
                               type="checkbox" 
                               data-tagid="{{{ $orderProduct->tag_id }}}" 
                               data-status='{{{ json_encode($orderProduct->tagStatusAvailable) }}}'
                               data-orderproductid='{{{ $orderProduct->id_order_product }}}'
                               value="{{{ $orderProduct->id_order_product }}}"
                               checked >
                    @endif
                    </td>
                    <td>{{{ $orderProduct->id_order_product }}}</td>
                    <td>{{{ $orderProduct->product->name }}}</td>
                    <td>{{{ $orderProduct->order_quantity }}}</td>
                    <td>PHP {{{ number_format($orderProduct->handling_fee, 2, '.', '') }}}</td>
                    <td>PHP {{{ number_format($orderProduct->total, 2, '.', '') }}}</td>
                    <td>PHP {{{ number_format($orderProduct->net, 2, '.', '') }}}</td>
                    <td class="tdrow-{{{$orderProduct->id_order_product}}}">
                        <span class="org_btn view " style="background-color:{{{ $orderProduct->tag_color }}}" > 
                            {{{ $orderProduct->tag_description ? $orderProduct->tag_description : "NO TAG" }}} 
                        </span>
                         @if($orderProduct->requestForRefund)
                        <span style="margin-right:20px;" class="label label-danger pull-right">!</span>
                        @endif
                    </td>
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

    @if(!$isFilter || $isFilter == $contactedTag)
    <div>
        Mark as:
        <select id="tagType">
            <option value="0">--Select Tag--</option>
        </select>
    </div>
    @endif
</div>
