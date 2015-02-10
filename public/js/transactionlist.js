(function ($) {

    $('.date').each(function() {
        $(this).datetimepicker({
            timepicker:false,
            format:'Y/m/d'
        });
    });

    
    $('.search-btn').click(function(){
        $('#transaction-form').submit();
    });
    
    $('#download-btn').click(function(){
        var action = $('#transaction-form').attr('action');
        $('#transaction-form').attr('action','/transaction/orderproduct-download');
        $('#transaction-form').submit();
        $('#transaction-form').attr('action',action);
    });
    
    
    $('.transaction-list td').click(function(){
        $this = $(this);
        var orderId = $this.siblings('.order-id').html();

         $.ajax({
                url: '/transaction/order-detail',
                data:{order_id:orderId},
                type: 'get',
                dataType: 'JSON',                      
                success: function(result){
                    var modal_container = $('<div></div>');
                    modal_container.append(result.html);
                    BootstrapDialog.show({
                        title: 'Order Details',
                        cssClass: 'order-detail-modal',
                        message: modal_container,
                        buttons: [{
                            label: 'Close',
                            action: function(dialogRef) {
                                dialogRef.close();
                            }
                        }]
                    });
                }
        });
        
    });
    
    
    $(document.body).on('click', '#order-product-tbl .view', function(){
        var orderProductId =  parseInt($(this).parent().data('order-product-id'), 10);
        $.ajax({
                url: '/transaction/orderproduct-detail',
                data:{order_product_id:orderProductId},
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
    
    
    $(document.body).on('click', '.op-void', function(){
        var $this = $(this);
        var orderProductId = $(this).parent().data('order-product-id');
        var canProceed = confirm("You are about to void order product: " + orderProductId + ", would you like to proceed?");
        
        if(canProceed){
            loader.showPleaseWait();  
            $.ajax({
                    url: '/transaction/order-product-void',
                    data:{ _method: 'put', order_product_id:orderProductId },
                    type: 'post',
                    dataType: 'JSON',                      
                    success: function(result){
                        loader.hidePleaseWait();  
                        $this.hide();
                        var success_html = '<div class="alert alert-success">' + 
                            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
                            'The database has been successfully updated.' +
                            '</div>'
                        $('.void-message').append(success_html);
                        setTimeout(function(){  location.reload(); }, 1500);    
                    }
            });
        }
    
    });
    
    $(document.body).on('click', '#o-void', function(){
        var orderId = $('#order-id').val();
        var transactionId = $('#transaction-id').val();
        var canProceed = confirm("You are about to void the entire transaction: " + transactionId + ", would you like to proceed?");
        if(canProceed){
            $.ajax({
                    url: '/transaction/order-void',
                    data:{ _method: 'put', order_id:orderId },
                    type: 'post',
                    dataType: 'JSON',                      
                    success: function(result){
                        $this.hide();
                        var success_html = '<div class="alert alert-success">' + 
                            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
                            'The database has been successfully updated.' +
                            '</div>'
                        $('.void-message').append(success_html);
                        setTimeout(function(){  location.reload(); }, 1500);    
                    }
            });
        }
        
    });

})(jQuery);

