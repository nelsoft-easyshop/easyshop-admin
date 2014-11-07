<div>
    <div class="table-responsive table-payment">   
        <table class="table table-striped table-hover" id="order-tbl">
            <tr>
                <td>Courier <span class="required-span">*</span></td>
                <td>{{ Form::text('courier', "", array('class' => 'form-control pull-left','placeholder' => 'Courier', 'id' => 'courier')) }}</td>
            </tr>
            <tr>
                <td>Tracking Number</td>
                <td>{{ Form::text('tracking', "", array('class' => 'form-control pull-left','placeholder' => 'Tracking Number', 'id' => 'tracking')) }}</td>
            </tr>
            <tr>
                <td>Comment</td>
                <td>
                {{ Form::textarea('shippingcomment', "", array('class' => 'form-control pull-left','placeholder' => 'Comment', 'id' => 'shipping-comment')) }}
                </td>
            </tr> 
            <tr>
                <td>Delivery Date <span class="required-span">*</span></td>
                <td>
                    <center>
                    <div class='date-cont pull-left'>
                    {{ Form::text('deliverydate', "", array('class' => 'date form-control pull-left date-readonly-control','placeholder' => 'Delivery Date','readonly' => '', 'id' => 'delivery-date')) }}
                    </div>
                    </center>
                </td>
            </tr>
            <tr>
                <td>Expected Date</td>
                <td>
                    <center>
                     <div class='date-cont pull-left'>
                    {{ Form::text('expecteddate', "", array('class' => 'date form-control pull-left date-readonly-control','placeholder' => 'Expected Date','readonly' => '', 'id' => 'expected-date')) }}
                    </div>
                    </center>
                </td>
            </tr> 
        </table>
        <div id="hidden-inputs">
            <input type="hidden" name="orderproductid" value="{{{ $orderProductId }}}" class="form-control pull-left" id="order-product-id" />
        </div>
    </div>
</div>
 
  {{ HTML::script('js/addshippingdetails.js') }} 
