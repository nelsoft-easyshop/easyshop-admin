<div>
    <div class="table-responsive table-payment"> 
        <table class="table table-striped table-hover" id="order-tbl">
            <tr class='head'> 
                <td>Order ID</td>
                <td>Date of Transaction</td>
                <td>Number of products</td> 
                <td></td>
            </tr>
            @foreach($transactionList as $orderProduct)
                <tr>
                    <td>{{{ $orderProduct->order_id }}}</td>
                    <td>{{{ $orderProduct->order->dateadded }}}</td>
                    <td>{{{ $orderProduct->count }}}</td> 
                    <td data-order-id='{{{ $orderProduct->order_id }}}'>
                        <span class="org_btn view"> View </span>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>