(function ($) {


    $('.buyer-list').click(function(){
        loader.showPleaseWait(); 
        var url = "/payout-buyer/view-transaction-details";
        var orderId = $(this).find('.td_order_id').html(); 
        var sellerID = $(this).find('.username').data("memberid"); 

        console.log(sellerID);
        var $request = $.ajax({
                url: url,
                data:{order_id:orderId, seller_id: sellerID},
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
        loader.showPleaseWait();
        var orderProductIdCollection =  [];

        var tag =  $('#tagOption option:selected').val();
        var sellerId =  $('#sellerID').val();
        $('.orderProductId').each(function(){
            orderProductIdCollection.push( parseInt($(this).html().trim(), 10));
        });

        $.ajax({
            url: "payout-buyer/update-buyer-transaction",
            data: {order_product_ids: orderProductIdCollection, tagId:tag, sellerId: sellerId},
            type: 'get',
            dataType: 'JSON',                      
            success: function(result){
                window.location.href = location.href;
            }
        });
       
    });
    
})(jQuery);

