$(document).ready(function(){

    
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
    
        
        

})


