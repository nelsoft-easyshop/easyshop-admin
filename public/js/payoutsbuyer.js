(function ($) {


    $('.transaction-list td').click(function(){
        BootstrapDialog.show({
            title: 'Order Details',
            cssClass: 'order-detail-modal',
            message: "test",
            buttons: [{
                label: 'Close',
                action: function(dialogRef) {
                    dialogRef.close();
                }
            }]
        });
        
    });
    
    
})(jQuery);

