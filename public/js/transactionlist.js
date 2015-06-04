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

    $(document.body).on('click', '#payment-method-list > li', function(){
        var $this = $(this);
        var $anchor = $this.find('a');
        var $value = $anchor.data('value');
        $('#payment-method-value').val($value);
        $('#payment-method-title').html($anchor.html());
    });

    $(document.body).on('click', '#order-status-list > li', function(){
        var $this = $(this);
        var $anchor = $this.find('a');
        var $value = $anchor.data('value');
        $('#order-status-value').val($value);
        $('#order-status-title').html($anchor.html());
    });

    var $orderStatusValue = $('#order-status-value').val().trim();
    if ($orderStatusValue !== "") {
        var $currentSelected = $("#order-status-list").find("[data-value='"+parseInt($orderStatusValue)+"']");
        $('#order-status-title').html($currentSelected.html());
    }

    var $paymentMethodSelected = $('#payment-method-value').val().trim();
    if ($paymentMethodSelected !== "") {
        var $currentSelected = $("#payment-method-list").find("[data-value='"+parseInt($paymentMethodSelected)+"']");
        $('#payment-method-title').html($currentSelected.html());
    }

    $(document.body).on('click', '.order-unflag-button', function(){       
        var orderId = $('#order-id').val();
        var userId = $('#userid').val();
        var webserviceBaseUrl = $('#webserviceUrl').val();

        var requestData = {
            orderId:orderId,
            userid:userId
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            $.ajax({
                url: webserviceBaseUrl + '/payment/unFlagOrder',
                data:requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(jsonResponse) {
                    if(jsonResponse.isSuccessful){
                        $('.order-unflag-button').fadeOut();
                        $('.transaction-flag-message').fadeOut();
                        var $unflagSuccessMessage = $('.unflag-success-message');
                        $unflagSuccessMessage.show();
                        setTimeout(function(){
                            $unflagSuccessMessage.fadeOut();
                        }, 2500);
                    }
                    else{
                        var $unflagFailMessage = $('.unflag-fail-message');
                        $unflagFailMessage.html('Error: ' + escapeHtml(jsonResponse.message));
                        $unflagFailMessage.show();
                        setTimeout(function(){
                            $unflagFailMessage.fadeOut();                            
                        }, 2500);
                    }
                },
                error: function(e) {
                    alert('An error occured while contacting the server. Please try again later.');
                }
            });  

        });

    });
    


})(jQuery);

