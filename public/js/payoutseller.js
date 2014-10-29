(function ($) {

    var updateStatus = function(order_id,member_id,tag_type){
        var $url = '/payout/seller/update-transaction';
        var $request = $.ajax({
                url: $url,
                data:{order_id:order_id,member_id:member_id,tag_type:tag_type},
                type: 'get',
                dataType: 'JSON',
                success: function(result){ 
                }
            });
    } 
    
    $('#requestRefundButton').click(function(){
        
    });

    $('.seller_detail').click(function(){
        loader.showPleaseWait();
        var $this = $(this);
        var $url = '/payout/seller/view-transactions-details'; 
        var $orderId = $this.find('.td_order_id').html(); 
        var $memberId = $this.find('.td_username').data('member-id'); 
        var $request = $.ajax({
                url: $url,
                data:{order_id:$orderId,member_id:$memberId},
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
                                    $tagType = $("#tagType").val();
                                    updateStatus($orderId,$memberId,$tagType);
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