<div>
    <div class="table-responsive table-payment"> 
        <table class="table table-striped table-hover" id="order-tbl">
            <tr class='head'> 
                <td>Order Product Id</td> 
                <td>Product Name</td> 
                <td>Order Quantity</td> 
            </tr>
            @foreach($transactionDetails as $orderProduct)
                <tr>
                    <td>{{{ $orderProduct->id_order_product }}}</td>
                    <td>{{{ $orderProduct->product->name }}}</td>
                    <td>{{{ $orderProduct->order_quantity }}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div>
        Mark as:
        <select id="tagType">
        @foreach($tags as $tag)
            @if($tag->id_tag_type === $currentStatus)
                <option value="{{{ $tag->id_tag_type }}}" selected >
                    {{{ $tag->tag_description }}}
                </option>
            @else
                <option value="{{{ $tag->id_tag_type }}}" >
                    {{{ $tag->tag_description }}}
                </option>
            @endif
        @endforeach
        </select>

        @if($requestForRefund)
            <label>
                Suggested for refund
            </label>
        @endif
    </div> 
        

</div>