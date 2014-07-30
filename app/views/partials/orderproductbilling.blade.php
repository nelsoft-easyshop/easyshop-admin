
<div class = "order_product_pay_container" >

    <span> Deposit to: </span>
    <select class="form-control">
        <!--
        @foreach($accounts as $account)
        <option>{{{  }}}</option>
        @endforeach
        -->
        <option>ADD PAYMENT ACCOUNT</option>
    </select>

    <hr/>

    <div class='left'>
        <div class="control-group">
            <p>
                <label for='form_accnt_name'><strong>Account Name:</strong></label> <span id="accnt_name"> SAM TEST </span>
                <input style='display:none' class='form-control' type='text' name='form_accnt_name' id='form_accnt_name'/>
            </p>

            <p>
                <label for='form_accnt_number'><strong>Account Number:</strong></label> <span id="accnt_number">SAM </span>
                <input style='display:none' class='form-control' type='text' name='form_accnt_number' id='form_accnt_number'/>
            </p>

            <p>
                <label for='form_accnt_bank'><strong>Bank:</strong></label> <span id="accnt_bank">SAM TEST</span>
                <select id="form_accnt_bank"  class='form-control' style='display:none' name='form_accnt_bank'>
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

</div>