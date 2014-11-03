<div>
    


    <div class="table-responsive table-payment"> 

        
        @if($hasShippingInformation)
        <table class="table table-striped table-hover" id="order-tbl"> 
            @foreach($shippingInfo as $shipping)
                <tr>
                    <td>Courier</td>
                    <td>{{{ $shipping->courier }}}</td>
                </tr>
                <tr>
                    <td>Tracking Number</td>
                    <td>{{{ $shipping->tracking_num }}}</td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td>{{{ $shipping->comment }}}</td>
                </tr>
                <tr>
                    <td>Date Submitted</td>
                    <td>{{{ $shipping->datemodified }}}</td>
                </tr>
                <tr>
                    <td>Delivery Date</td>
                    <td>{{{ $shipping->delivery_date }}}</td>
                </tr>
                <tr>
                    <td>Expected Date</td>
                    <td>{{{ $shipping->expected_date }}}</td>
                </tr>
            @endforeach
        </table>
        @else
            <div>
                <h1>No available shipping details.</h1>
            </div>
        @endif
    </div>
</div>

