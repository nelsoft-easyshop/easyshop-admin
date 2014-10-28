(function ($) {

    $('.seller_detail').click(function(){
        loader.showPleaseWait();
        var $this = $(this);
        var $url = '/payout/seller/view-transactions-details'; 
        var $orderId = $this.find('.td_order_id').html(); 
        var $request = $.ajax({
                url: $url,
                data:{order_id:$orderId},
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
 

})(jQuery);