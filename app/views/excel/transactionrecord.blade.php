<table>
    <thead>
        <tr>
            <th>ORDER ID</th>
            <th>TRANSACTION ID</th>
            <th>INVOICE NUMBER</th>
            <th>ITEM</th>
            <th>QUANTITY</th>
            <th>ITEM PRICE</th>
            <th>HANDLING FEE</th>
            <th>TOTAL PRICE</th>
            <th>ORDER STATUS</th>
            <th>PAYMENT METHOD</th>
            <th>CASH OUT STATUS</th>
            <th>SHIPPING ADDRESS</th>
            <th>CITY</th>
            <th>STATE REGION</th>
            <th>COUNTRY</th>
            <th>DELIVERY STATUS</th>
            <th>BUYER'S USERNAME</th>
            <th>BUYER'S FULLNAME</th>
            <th>BUYER'S CONTACT NUMBER</th>
            <th>BUYER'S EMAIL ADDRESS</th>
            <th>SELLER'S USERNAME</th>
            <th>SELLER'S FULLNAME</th>
            <th>SELLER'S CONTACT NUMBER</th>
            <th>SELLER'S EMAIL ADDRESS</th>
            <th>URL</th>
            <th>DATE ADDED</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactionRecord as $key => $record)
        <tr>
            <td style="text-align: center" >{{{ $record['Order_ID'] }}}</td>
            <td style="text-align: center" >{{{ $record['Transaction_ID'] }}}</td>
            <td style="text-align: center" >{{{ $record['Invoice_number'] }}}</td>
            <td>{{{ $record['Product'] }}}</td>
            <td style="text-align: center" >{{{ $record['Quantity'] }}}</td>
            <td style="text-align: center" >{{{ $record['Item_price'] }}}</td>
            <td style="text-align: center" >{{{ $record['Handling_fee'] }}}</td>
            <td style="text-align: center" >{{{ $record['Total_price'] }}}</td>
            <td>{{{ $record['Order_status'] }}}</td>
            <td>{{{ $record['Payment_method'] }}}</td>
            <td>{{{ $record['Cash_out_status'] }}}</td>
            <td>{{{ $record['Shipping_address'] }}}</td>
            <td>{{{ $record['City'] }}}</td>
            <td>{{{ $record['Region'] }}}</td>
            <td>{{{ $record['Country'] }}}</td>
            <td>{{{ $record['Delivery_status'] }}}</td>
            <td>{{{ $record['Buyers_username'] }}}</td>
            <td>{{{ $record['Buyers_fullname'] }}}</td>
            <td style="text-align: center" >{{{ $record['Buyers_contact_number'] }}}</td>
            <td>{{{ $record['Buyers_email_address'] }}}</td>
            <td>{{{ $record['Sellers_username'] }}}</td>
            <td>{{{ $record['Sellers_fullname'] }}}</td>
            <td style="text-align: center" >{{{ $record['Sellers_contact_number'] }}}</td>
            <td>{{{ $record['Sellers_email_address'] }}}</td>
            <td>{{{ $record['URL'] }}}</td>
            <td>{{{ $record['Date_added'] }}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
