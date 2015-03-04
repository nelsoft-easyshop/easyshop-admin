(function ($){ 
        $('.notif-button ').on('click',function(){
            var apiType = $(this).data('type');
            BootstrapDialog.confirm('Are you sure you want to update?', function(result){
                if(result) {
                    loader.showPleaseWait();
                    $.ajax({
                        url:'/mobile/push-notification/notify',
                        type:'GET',
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
