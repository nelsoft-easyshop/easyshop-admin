(function ($) {

    
    $('.seller_detail').click(function(){
        var username = $(this).find('.td_username').html();
        var accountname = $(this).find('.td_accountname').html();
        var accountno = $(this).find('.td_accountno').html();
        $.ajax({
                url: 'orderproduct',
                data:{username:username,accountname:accountname,accountno:accountno},
                type: 'get',
                dataType: 'JSON',                      
                success: function(result){
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
                        message: modal_container,
                        cssClass: 'payment-dialog-pay',
                        buttons: [{
                            label: 'Pay with this account',
                            cssClass: 'btn-pay-account',
                            icon: 'glyphicon glyphicon-check',
                            action: function(dialogRef) {
                        
                            }
                        }]
                    });
                }
                    
        });
       
       
    });
    
    
    $(document).on('click','#edit_account',function(){

        $('.errors').children().fadeOut(500, function() {
            $('.errors').empty();
        });
        
        $('#accnt_name').css('display', 'none');
        $('#accnt_number').css('display', 'none');
        $('#accnt_bank').css('display', 'none');
        
        var accnt_name = $('#accnt_name').html().trim();
        var accnt_number = $('#accnt_number').html().trim();
        var accnt_bank = $('#accnt_bank_id').val();
        var billing_info_id = $('#account_collection').val();
        
        $('#form_accnt_name').val(accnt_name);
        $('#form_accnt_number').val(accnt_number);
        $('#form_accnt_bank').val(accnt_bank );
        
        $('#form_accnt_name').css('display', 'inline');
        $('#form_accnt_number').css('display', 'inline');
        $('#form_accnt_bank').css('display', 'inline');
        
        $('#edit_account').hide();
        $('#save_account').show();
    });
    
    $(document).on('click','#save_account',function(){
        
        var accnt_name = $('#form_accnt_name').val().trim();
        var accnt_number = $('#form_accnt_number').val().trim();
        var accnt_bank = $('#form_accnt_bank').val();
        var billing_info_id = $('#account_collection').val();

        $.ajax({
            url: 'billinginfo',
            data:{_method: 'put', billing_info_id:billing_info_id, account_name:accnt_name, account_number:accnt_number, bank_id:accnt_bank},
            type: 'post',
            dataType: 'JSON',                      
            success: function(result){
                if(isEmpty(result.errors)){
                    $('#accnt_name').html(accnt_name);
                    $('#accnt_number').html(accnt_number);
                    $('#accnt_bank_id').val(accnt_bank);
                    $('#accnt_bank').html($('#form_accnt_bank option:selected').html());

                }else{
                    
                    $.each(result.errors, function(){
                        var alert_html = 
                            '<div class="alert alert-warning">' +
                                '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
                                $(this)[0] +
                            '</div>';
                        $('.errors').append(alert_html);
                        
                    });
                    
                    
                }
         

            }           
        });
        
        $('#accnt_name').css('display', 'inline');
        $('#accnt_number').css('display', 'inline');
        $('#accnt_bank').css('display', 'inline');

        $('#form_accnt_name').css('display', 'none');
        $('#form_accnt_number').css('display', 'none');
        $('#form_accnt_bank').css('display', 'none');
        
        $('#edit_account').show();
        $('#save_account').hide();
    });
        

})(jQuery);


