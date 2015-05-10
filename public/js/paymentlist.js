(function ($) {

    $('.date').each(function() {
        $(this).datetimepicker({
            timepicker:false,
            format:'Y/m/d'
        });
    });


    $('.seller_detail, .buyer_detail').click(function(){
        var $this = $(this);
        var username = $this.find('.td_username').html();
        var accountname = $this.find('.td_accountname').html();
        var order_product_ids = $this.data('order-product-ids');
        
        var url = $this.hasClass('buyer_detail') ? '/transaction/orderproduct/refund' : '/transaction/orderproduct/pay';
        loader.showPleaseWait();        

        $.ajax({
                url: url,
                data:{order_product_ids:order_product_ids},
                type: 'get',
                dataType: 'JSON',                      
                success: function(result){
                    loader.hidePleaseWait();
                    var modal_container = $('<div class="order_product"></div>');
                    modal_container.append(result.html);
                    BootstrapDialog.show({
                        title: username,
                        message: modal_container,
                        cssClass: 'payment-dialog',
                    });
                }
                    
        });
    });
    

    $(document.body).on('click','.view',function(){
        var order_product_id =  $(this).closest('.order_product').data('orderproductid');
         $.ajax({
                url: '/transaction/orderproduct-detail',
                data:{order_product_id:order_product_id},
                type: 'get',
                dataType: 'JSON',                      
                success: function(result){
                    var modal_container = $('<div></div>');
                    modal_container.append(result.html);
                    BootstrapDialog.show({
                        title: 'History Information',
                        message: modal_container,
                        cssClass: 'payment-dialog',
                        buttons: [{
                            label: 'Back',
                            action: function(dialogRef) {
                                dialogRef.close();
                            }
                        }]
                    });
                }
                    
        });
       
       
    });
    
    
    
    $(document.body).on('click','.op-pay-btn',function(){
        var $this = $(this);
        var url =  $this.hasClass('seller') ? '/transaction/orderproduct-payment/refund' : '/transaction/orderproduct-payment/pay';
        var orderProductIdCollection =  [];

        $('.order_product td input.checkbox-order-product-id:checked').each(function(){
            orderProductIdCollection.push( parseInt($(this).closest('tr.order_product').data('orderproductid'), 10));
        });

        if(orderProductIdCollection.length == 0){
            return false;
        }

        $.ajax({
                url: url,
                data:{order_product_ids:orderProductIdCollection},
                type: 'get',
                dataType: 'JSON',                      
                success: function(result){
                    var modal_container = $('<div></div>');
                    modal_container.append(result.html);
                    BootstrapDialog.show({
                        title: 'Account Payment',
                        message: function(dialogRef){
                            var $message = modal_container;
                            var $button = $('<div style="text-align:center"><button type="submit" class="btn btn-pay-account ladda-button" id="pay_account" data-style="zoom-out" style="">' +
                                                '<span class="ladda-label">' +
                                                    '<span class="glyphicon glyphicon-check"></span> Pay with this account' +
                                                '</span>' +
                                            '</button><div>');
                            $button.on('click', {dialogRef: dialogRef}, function(event){
                                payAccount();
                            });
                            $message.append($button);
                            return $message; 
                        },
                        cssClass: 'payment-dialog-pay',
                        onshown: function(dialogRef){
                            var $account_collection = $('#account_collection');
                            var selectedOption = $account_collection.find('option:selected');
                            if(selectedOption.hasClass('add-option')||selectedOption.hasClass('paypal')){
                                $('#account_collection').change();
                            }
                             
                        },
                    });
                }    
        });
       
       
    });
    
   
    
    $(document.body).on('click','#edit_account',function(){

        emptyErrors();
        
        var accnt_name = $('#accnt_name').html().trim();
        var accnt_number = $('#accnt_number').html().trim();
        var accnt_bank = $('#accnt_bank_id').val();
        var billing_info_id = $('#account_collection').val();
        
        $('#form_accnt_name').val(accnt_name);
        $('#form_accnt_number').val(accnt_number);
        $('#form_accnt_bank').val(accnt_bank );
        showInputs();
    });
    

    $(document.body).on('click','#cancel_account',function(){
        emptyErrors(); 
        hideInputs();
    });
    
    $(document.body).on('click','#save_account',function(){
        $('#error-container').children().fadeOut(500);        
        var $this = $(this);
        var accnt_name = $('#form_accnt_name').val().trim();
        var accnt_number = $('#form_accnt_number').val().trim();
        var accnt_bank = $('#form_accnt_bank').val();
        var accnt_bank_name =  $('#form_accnt_bank').find('option:selected').html();
        var billing_info_id = $('#account_collection').val();
        var selected_account = $('#account_collection').find('option:selected');
        var order_billing_info_id = selected_account.data('order-billing-id');

        var member_id =  ($('#action').val() == 'pay')  ?  $('#seller_id').val() : $('#buyer_id').val();

        var spinner = Ladda.create(this);
        spinner.start();
        
        var json_data = {};
        var isCreate = billing_info_id == 0;

        if(isCreate){
            json_data = {
                account_name:accnt_name, 
                account_number:accnt_number, 
                bank_id:accnt_bank, 
                member_id:  member_id

            };
        }else{
            json_data = {
                _method: 'put', 
                billing_info_id:billing_info_id, 
                account_name:accnt_name,
                account_number:accnt_number,
                bank_id:accnt_bank ,
                member_id: member_id
            };
        }
        $.ajax({
            url: '/transaction/billinginfo',
            data: json_data,
            type: 'post',
            dataType: 'JSON',                      
            success: function(result){
                spinner.stop();
                if(isEmpty(result.errors)){
                    $('#accnt_name').html(accnt_name);
                    $('#accnt_number').html(accnt_number);
                    $('#accnt_bank_id').val(accnt_bank);
                    $('#accnt_bank').html(accnt_bank_name);
                    if(isCreate){
                        var option_html = '<option value="'+result.newBillingInfoId+'" data-bank-id="'+accnt_bank+'" data-name="'+accnt_name+'" data-number="'+accnt_number+'" data-bank-name="'+accnt_bank_name+'" selected>'+accnt_bank_name+' - '+accnt_name+'</option>';
                        $(option_html).insertBefore('#account_collection option#add-option');
                        $('#account_collection').val(result.newBillingInfoId);
                    }
                    else{
                        selected_account.data('bank-id', accnt_bank);
                        selected_account.data('name', accnt_name);
                        selected_account.data('number', accnt_number);
                        selected_account.data('bank-name' , accnt_bank_name);
                        selected_account.html(accnt_bank_name+' - '+ accnt_name);
                    }
                    
                    if($.isNumeric(order_billing_info_id)){
                        selected_account.remove(); 
                    }
                    
                    hideInputs();
                }
                else{
                    $.each(result.errors, function(){
                        var alert_html = 
                            '<div class="alert alert-warning">' +
                                '<a href="#" class="close" data-dismiss="alert">&times;</a>' + $(this)[0] +
                            '</div>';
                        $('#error-container').prepend(alert_html);
                    });  
                }
            }           
        });

    });
    
    $(document.body).on('keyup','#form-paypal-account',function(){
        $("#inputs-container").removeClass("has-error");
    });
        
    $(document.body).on('change','#account_collection',function(){
        emptyErrors();
        $("#inputs-container").removeClass("has-error");
        var $this = $(this)
        var billing_info_id = $this.val();
        var selectedOption = $this.find('option:selected');
        var account_order_billing_id = selectedOption.data('order-billing-id');
        $('#inputs-container p:not(.paypal-container)').show();
        $('.paypal-container').hide();
      
        if(billing_info_id == 0 && account_order_billing_id ==  undefined){            
            $('#form_accnt_name').val('');
            $('#form_accnt_number').val('');
            $('#form_accnt_bank').val(1);
            showInputs();
            $('#cancel_account').hide();
        }else{
            $('#accnt_name').html(selectedOption.data('name'));
            $('#accnt_number').html(selectedOption.data('number'));
            $('#accnt_bank').val(selectedOption.data('bank-id')); 
            hideInputs();   
            if(billing_info_id == 'paypal'){
                $('#edit_account').hide();
                $('#inputs-container p:not(.paypal-container)').hide();
                $('.paypal-container').show();
            }
        }

    });
    
    function payAccount()
    {
        var isPayment = ($('#action').val() == 'pay');
        var member_id =  isPayment  ?  $('#seller_id').val() : $('#buyer_id').val();
        var url = isPayment ? '/transaction/orderproduct-status/pay' : '/transaction/orderproduct-status/refund'; 
        
        var selected_option = $('#account_collection').find('option:selected');
        
        if(selected_option.val() == 'paypal'){
            var account_name = 'PAYPAL';
            var bank_name = 'PAYPAL';
            var account_number = $('#form-paypal-account').val();
            if($.trim(account_number) == ""){
                $("#inputs-container").addClass("has-error");
                return false;
            }
        }
        else{
            var account_name = selected_option.data('name');
            var account_number = selected_option.data('number');
            var bank_name = selected_option.data('bank-name');            
        }
      
        var order_product_ids = $('#order_product_ids').val();
        var dateFrom = $('input#date-from').val();
        var dateTo = $('input#date-to').val();

        var spinner =  Ladda.create( document.querySelector( 'button.btn-pay-account' ) );
        spinner.start();
        
        $.ajax({
            url: url,
            data: {_method: 'put', order_product_ids: order_product_ids,  account_name: account_name, account_number: account_number, bank_name:bank_name, member_id:member_id, dateFrom: dateFrom, dateTo: dateTo},
            type: 'post',
            dataType: 'JSON',                      
            success: function(result){
                spinner.stop();
                if(result){
                    $('#pay_account').remove();
                    var success_html = '<div class="alert alert-success">' + 
                                        '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
                                        'The database has been successfully updated.' +
                                     '</div>'
                    $('.payment_message').prepend(success_html);
                    setTimeout(function(){  location.reload(); }, 1500);    
                }
                    
            }
        });
    
    }

    
    function showInputs()
    {
            $('#form_accnt_name').css('display', 'inline');
            $('#form_accnt_number').css('display', 'inline');
            $('#form_accnt_bank').css('display', 'inline');
   
            $('#accnt_name').css('display', 'none');
            $('#accnt_number').css('display', 'none');
            $('#accnt_bank').css('display', 'none');      
                
            $('#edit_account').hide();
            $('#save_account').show();
            $('#cancel_account').show();
            $('.btn-pay-account').hide();
    }
    
    function hideInputs()
    {
            $('#form_accnt_name').css('display', 'none');
            $('#form_accnt_number').css('display', 'none');
            $('#form_accnt_bank').css('display', 'none');
            
            $('#accnt_name').css('display', 'inline');
            $('#accnt_number').css('display', 'inline');
            $('#accnt_bank').css('display', 'inline');    
            
            $('#save_account').hide();
            $('#cancel_account').hide();
            $('#edit_account').show();
            $('.btn-pay-account').show();
    }
    
    function emptyErrors()
    {
        var errorContainer = $('#error-container');
        errorContainer.children().fadeOut(500, function() {
            errorContainer.empty();
        });
    }

})(jQuery);


