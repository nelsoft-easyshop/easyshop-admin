(function ($){ 
        $('.notif-button ').on('click',function(){
            var apiType = $(this).data('type');
            BootstrapDialog.confirm('Proceed with sending push notification?', function(result){
                if(result) {
                    loader.showPleaseWait();
                    $.ajax({
                        url:'/mobile/push-notification/notify',
                        type:'POST',
                        data:{ 
                            message: $("#message-txt").val(),
                            apiType: apiType
                        },
                        success:function(result){ 
                            loader.hidePleaseWait();
                        }
                    });
                }
            });
        }); 

})(jQuery);
