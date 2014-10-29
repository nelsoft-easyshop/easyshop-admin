(function ($) {


    $('.buyer-list').click(function(){
        loader.showPleaseWait(); 
        var url = "/payout-buyer/view-transaction-details";
        var orderId = $(this).find('.td_order_id').html(); 
        var $request = $.ajax({
                url: url,
                data:{order_id:orderId},
                type: 'get',
                dataType: 'JSON',
                success: function(result){
                    var modal_container = $('<div></div>');
                    modal_container.append(result.html); 
                    loader.hidePleaseWait();
                    BootstrapDialog.show({
                        title: 'History Information',
                        message: modal_container,
                        cssClass: 'payment-dialog',
                        buttons: [
                            {
                                id: "tagOrder",
                                label: 'Save',
                                action: function(dialogRef) {
                                    dialogRef.close();
                                }
                            },
                            {
                                label: 'Back',
                                action: function(dialogRef) {
                                    dialogRef.close();
                                }
                            }
                        ]
                    });
                }
            });
    });

    $(document.body).on('click','#tagOrder',function(){
        var orderProductIdCollection =  [];

        var tag =  $('#tagOption option:selected').val();
        $('.orderProductId').each(function(){
            orderProductIdCollection.push( parseInt($(this).html().trim(), 10));
        });
        console.log(orderProductIdCollection);

        $.ajax({
            url: "payout-buyer/contact-buyer",
            data: {order_product_ids: orderProductIdCollection},
            type: 'get',
            dataType: 'JSON',                      
            success: function(result){
                spinner.stop();

            }
        });
       
    });
    
})(jQuery);

