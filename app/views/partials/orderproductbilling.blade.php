<div class = "order_product_pay_container" >

    <span> Deposit to: </span>
    <select class="form-control" id="account_collection">
        @foreach($accounts as $account)
            <option value="{{{ $account->billing_id  }}}" data-bank-name="{{{ $account->bank_name }}}" data-bank-id="{{{ $account->bank_id }}}" data-name="{{{ $account->account_name }}}" data-number="{{{ $account->account_number }}}"  data-order-billing-id = "{{{ $account->order_billing_id }}}"   >{{{ $account->bank_name }}} - {{{ $account->account_name }}} {{ is_numeric($account->order_billing_id) ? '[NEW]' : '' }}     </option>
        @endforeach

        @if($action === 'refund')
            <option value="paypal" class="paypal">Refunded via Paypal</option>
        @endif
        
        <option value="0" id="add-option" class="add-option">ADD PAYMENT ACCOUNT</option>
    </select>

    <hr/>

    <div class='left'>
        <div class="control-group" id="inputs-container">
        
        
            <p>
                <label for='form_accnt_name'><strong>Account Name:</strong></label> <span id="accnt_name"> {{{ $accounts[0]->account_name or '' }}} </span>
                <input  style="display:none" class='form-control' type='text' name='form_accnt_name' id='form_accnt_name'/>
            </p>

            <p>
                <label for='form_accnt_number'><strong>Account Number:</strong></label> <span id="accnt_number"> {{{ $accounts[0]->account_number or '' }}} </span>
                <input style="display:none" class='form-control' type='text' name='form_accnt_number' id='form_accnt_number'/>
            </p>

            <p>
                <label for='form_accnt_bank'><strong>Bank:</strong></label> <span id="accnt_bank">{{{ $accounts[0]->bank_name or '' }}}</span>
                <input type="hidden" id="accnt_bank_id" value="{{{ $accounts[0]->bank_id or 0 }}}"/>
                <select id="form_accnt_bank"  class="form-control" name='form_accnt_bank' style="display:none">
                    @foreach($bankList as $bank)
                        <option value="{{{ $bank->id_bank }}}">{{{ $bank->bank_name }}}</option>
                    @endforeach
                </select>
            </p>
            
            
            <p style="display:none" class="paypal-container">
                <label for="paypal-account"><strong>Paypal Account:</strong></label>
                <input style="display:inline" class='form-control' type='text' name='form-paypal-account' id='form-paypal-account'/>
            </p>
            
        </div>
        
    

    </div>
    
    <div class='right'>
    
        <button type="submit" class="btn btn-default" id="edit_account">
            <span class="glyphicon glyphicon-pencil"></span> Edit
        </button>  
        
        <button type="submit" class="btn btn-default  ladda-button" id="save_account" style="display:none" data-style="zoom-out">
            <span class="ladda-label">
                <span class="glyphicon glyphicon-check"></span> Save
            </span>
        </button>

        <button type="submit" class="btn btn-default" style="display:none" id="cancel_account">
            <span class="glyphicon glyphicon-remove-sign"></span> Cancel
        </button>
        
    </div>

    
    <div style="clear:both"></div>
    
    <div id="error-container"></div>
    <div class="payment_message"></div>
    
    <input type="hidden" id="action" value = "{{{ $action }}}"/>
    <input type="hidden" id="seller_id" value="{{{ $seller_id or 0 }}}"/>
    <input type="hidden" id="buyer_id" value="{{{ $buyer_id or 0 }}}"/>
    <input type="hidden" id="order_product_ids" value="{{{ $order_product_ids }}}"/>

</div>