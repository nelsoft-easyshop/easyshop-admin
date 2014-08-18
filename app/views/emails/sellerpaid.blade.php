@extends('emails.layout')

@section('email-tbl-body')
    <tbody>
        <tr>
            <td>
                <p>
                Dear {{{ $recipient }}},
                </p>
                <p>
                    Thank you for selling through Easyshop.ph! The payment for your sales from  {{{ $startPayOutDate->format('F j, Y') }}} until {{{ $endPayOutDate->format('F j, Y') }}} has now been forwarded to your account. Details for your transactions are included below.
                </p>
            </td>
        </tr>
        
        <tr>
            <td>
                <p>
                    <strong> Account Name: </strong>{{{ $bankName }}} - {{{ $accountName }}}
                </p>
                <p>
                    <strong> Account Number: </strong> {{{ $accountNumber }}}
                </p>
            </td>
        </tr>  
    </tbody>
@stop

@section('email-sub-tbl')
    
    <table style="text-align: center; border-collapse:collapse">
        <tbody>
            <tr style="font-weight:bold; background-color: #f18200; color: white; ">
                <td style="padding: 4px;">Invoice No.</td>
                <td style="padding: 4px;">Buyer</td>
                <td style="padding: 4px;">Product Name</td>
                <td style="padding: 4px;">Qty.</td>
                <td style="padding: 4px;">Unit Price</td>
                <td style="padding: 4px;">Shipment Price</td>
                <td style="padding: 4px;">Total Amount</td>
                <td style="padding: 4px;">Easyshop Charge</td>
                <td style="padding: 4px;">Payment Charge</td>
                <td style="padding: 4px;">Net</td>
            </tr>
            @foreach($orderProducts as $idx=>$orderProduct)
                <tr style="color: black; background-color:  {{{ ($idx%2 === 0) ? '#f5f5f5': 'ffffff'   }}};" >
                    <td style="padding: 4px;">{{{ $orderProduct->order->invoice_no }}}</td>
                    <td style="padding: 4px;">{{{ $orderProduct->order->buyer->username }}}</td>
                    <td style="padding: 4px;">{{{ $orderProduct->product->name }}}</td>
                    <td style="padding: 4px;">{{{ $orderProduct->order_quantity }}}</td>
                    <td style="padding: 4px;">{{ number_format($orderProduct->price,2,'.',',') }}</td>
                    <td style="padding: 4px;">{{ number_format($orderProduct->handling_fee,2,'.',',') }}</td>
                    <td style="padding: 4px;">{{ number_format($orderProduct->total,2,'.',',') }}</td>
                    <td style="padding: 4px;">{{ number_format($orderProduct->easyshop_charge,2,'.',',') }}</td>
                    <td style="padding: 4px;">{{ number_format($orderProduct->payment_method_charge,2,'.',',') }}</td>
                    <td style="padding: 4px;"><b>{{ number_format($orderProduct->net,2,'.',',') }}</b></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop