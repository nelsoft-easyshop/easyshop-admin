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
                    <td class="orderProductId">{{{ $orderProduct->id_order_product }}}</td>
                    <td>{{{ $orderProduct->product->name }}}</td>
                    <td>{{{ $orderProduct->order_quantity }}}</td>
                </tr>
            @endforeach
        </table>

        <table>
            <div>
                Mark as: 
                <tr>
                <td><form id="form">
                    <select id="tagOption">
                    @foreach($tags as $tag)
                        <option value="{{{ $tag->id_tag_type }}}" >{{{ $tag->tag_description }}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="sellerID" id="sellerID" value="{{{ $sellerId }}}">
                </form></td>
                <td> {{ ($suggestForRefund) ?  "<span class='org_btn view'>Suggest For Refund</span>" : "" }}</td></tr>
            </div>
         </table>        
    </div>
</div>