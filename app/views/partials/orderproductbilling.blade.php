
<div class = "order_product_pay_container" >

    <span> Deposit to: </span>
    <select class="form-control" id="account_collection">
        @foreach($accounts as $account)
            <option value="{{{ $account->id_billing_info  }}}">{{{ $account->bankInfo->bank_name }}} - {{{ $account->bank_account_name }}}</option>
        @endforeach
        <option value="0">ADD PAYMENT ACCOUNT</option>
    </select>

    <hr/>

    <div class='left'>
        <div class="control-group">
            <p>
                <label for='form_accnt_name'><strong>Account Name:</strong></label> <span id="accnt_name"> {{{ $accounts[0]->bank_account_name or '' }}} </span>
                <input style='display:none' class='form-control' type='text' name='form_accnt_name' id='form_accnt_name'/>
            </p>

            <p>
                <label for='form_accnt_number'><strong>Account Number:</strong></label> <span id="accnt_number"> {{{ $accounts[0]->bank_account_number or '' }}} </span>
                <input style='display:none' class='form-control' type='text' name='form_accnt_number' id='form_accnt_number'/>
            </p>

            <p>
                <label for='form_accnt_bank'><strong>Bank:</strong></label> <span id="accnt_bank">{{{ $accounts[0]->bankInfo->bank_name or '' }}}</span>
                <input type="hidden" id="accnt_bank_id" value="{{{ $accounts[0]->bankInfo->id_bank }}}"/>
                <select id="form_accnt_bank"  class='form-control' style='display:none' name='form_accnt_bank'>
                    @foreach($bankList as $bank)
                        <option value="{{{ $bank->id_bank }}}">{{{ $bank->bank_name }}}</option>
                    @endforeach
                </select>
            </p>
        </div>
    </div>
    
    <div class='right'>
        <button type="submit" class="btn btn-default" id="edit_account">
            <span class="glyphicon glyphicon-pencil"></span> Edit
        </button>
        
        <button type="submit" class="btn btn-default" id="save_account" style='display:none'>
            <span class="glyphicon glyphicon-check"></span> Save
        </button>
    </div>
    
    <div style="clear:both"></div>
    
    <div class="errors"></div>


</div>