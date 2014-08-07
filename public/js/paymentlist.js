(function ($) {

    
    $('.seller_detail').click(function(){
        var $this = $(this);
        var username = $this.find('.td_username').html();
        var accountname = $this.find('.td_accountname').html();
        var accountno = $this.find('.td_accountno').html();
        var bankname = $this.find('.td_bankname').html();

        var dateFrom = $('input#date-from').val();
        var dateTo = $('input#date-to').val();

        
        loader.showPleaseWait();        
        $.ajax({
                url: 'orderproduct',
                data:{username:username,accountname:accountname,accountno:accountno, bankname:bankname, dateFrom: dateFrom, dateTo: dateTo},
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
    

    $(document).on('click','.view',function(){
        var order_product_id =  $(this).closest('.order_product').data('orderproductid');
         $.ajax({
                url: 'orderproduct-history',
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
    
    
    
    $(document).on('click','.pay',function(){
        var order_product_id =  $(this).closest('.order_product').data('orderproductid');
         $.ajax({
                url: 'orderproduct-payment',
                data:{order_product_id:order_product_id},
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
                    });   
                }
                    
        });
       
       
    });
    
   
    
    $(document).on('click','#edit_account',function(){

        $('.errors').children().fadeOut(500, function() {
            $('.errors').empty();
        });
        
        
        var accnt_name = $('#accnt_name').html().trim();
        var accnt_number = $('#accnt_number').html().trim();
        var accnt_bank = $('#accnt_bank_id').val();
        var billing_info_id = $('#account_collection').val();
        
        $('#form_accnt_name').val(accnt_name);
        $('#form_accnt_number').val(accnt_number);
        $('#form_accnt_bank').val(accnt_bank );
        
        showInputs();
    });
    
    $(document).on('click','#cancel_account',function(){
        $('.errors').children().fadeOut(500, function() {
            $('.errors').empty();
        });
               
        hideInputs();
    });
    
    $(document).on('click','#save_account',function(){
        
        $('.errors').children().fadeOut(500);
        
        var accnt_name = $('#form_accnt_name').val().trim();
        var accnt_number = $('#form_accnt_number').val().trim();
        var accnt_bank = $('#form_accnt_bank').val();
        var accnt_bank_name =  $('#form_accnt_bank').find('option:selected').html();
        var billing_info_id = $('#account_collection').val();
        var selected_account = $('#account_collection').find('option:selected');
        var order_billing_info_id = selected_account.data('order-billing-id');
        
        var seller_id = $('#seller_id').val();
        
        var spinner = Ladda.create(this);
        spinner.start();
        
        var json_data = {};
        var isCreate = billing_info_id == 0;
        
        if(isCreate){
            json_data = {account_name:accnt_name, account_number:accnt_number, bank_id:accnt_bank, seller_id: seller_id };
        }else{
            json_data = {_method: 'put', billing_info_id:billing_info_id, account_name:accnt_name, account_number:accnt_number, bank_id:accnt_bank , seller_id: seller_id};
        }
        
        $.ajax({
            url: 'billinginfo',
            data: json_data,
            type: 'post',
            dataType: 'JSON',                      
            success: function(result){
                spinner.stop();
                if(isEmpty(result.errors)){
                    $('#accnt_name').html(accnt_name);
                    $('#accnt_number').html(accnt_number);
                    $('#accnt_bank_id').val(accnt_bank);
                    $('#accnt_bank').html($('#form_accnt_bank option:selected').html());
                    if(isCreate){
                        var option_html = '<option value='+result.new_billing_info_id+' data-bank-id='+accnt_bank+' data-name='+accnt_name+' date-number='+accnt_number+' selected>'+accnt_bank_name+' - '+accnt_name+'</option>';
                        $(option_html).insertBefore('#account_collection option#add-option');
                    }
                    
                    if($.isNumeric(order_billing_info_id)){
                        selected_account.remove(); 
                    }
                    
                    hideInputs();
                }else{
                    $.each(result.errors, function(){
                        var alert_html = 
                            '<div class="alert alert-warning">' +
                                '<a href="#" class="close" data-dismiss="alert">&times;</a>' + $(this)[0] +
                            '</div>';
                        $('.errors').prepend(alert_html);
                    });  
                }
            }           
        });


    });
        
    $(document).on('change','#account_collection',function(){
        var $this = $(this)
        var billing_info_id = $this.val();
        var selectedOption = $this.find('option:selected');
        var account_order_billing_id = selectedOption.data('order-billing-id');

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
        }

    });
    
    function payAccount()
    {
        var selected_option = $('#account_collection').find('option:selected');
        var account_name = selected_option.data('name');
        var account_number = selected_option.data('number');
        var bank_name = selected_option.data('bank-name');
        var seller_id = $('#seller_id').val();
        var order_product_id = $('#order_product_id').val();
        
        var dateFrom = $('input#date-from').val();
        var dateTo = $('input#date-to').val();
        
        var spinner =  Ladda.create( document.querySelector( 'button.btn-pay-account' ) );
        spinner.start();
           
        $.ajax({
            url: 'orderproduct-status/forward',
            data: {_method: 'put', order_product_id: order_product_id,  account_name: account_name, account_number: account_number, bank_name:bank_name, seller_id:seller_id, dateFrom: dateFrom, dateTo: dateTo},
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
    }
    

})(jQuery);


