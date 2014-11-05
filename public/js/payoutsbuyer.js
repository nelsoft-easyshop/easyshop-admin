(function ($) {
    if(getParameterByName("page")) {
        $("#pageNumber").val(getParameterByName("page"));
    }
    $('.buyer-list').click(function(){
        loader.showPleaseWait(); 
        var url = "/payout-buyer/view-transaction-details";
        var orderId = $(this).find('.td_order_id').html(); 
        var sellerID = $(this).find('.username').data("memberid"); 

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
    $(document.body).on('click','.drct_search',function(){
            var id = $(this).attr('data');
            var text = $('#filterBy').val(id);
            $('#searchForm').submit();        
    });     
    $(document.body).on('click','thead th span',function(){
        var filter = $('#filterSort').val();
        var filterBy = $('#filterBySort').val();        
        if($(this).hasClass("glyphicon-chevron-up")) {
            $(this).attr("class","glyphicon glyphicon-chevron-down");
            $(this).data("sortorder","asc");
        }
        else {
            $(this).attr("class","glyphicon glyphicon-chevron-up");
            $(this).data("sortorder", "desc");

        }
        var tempSort = $(this).data("sortby");
        var tempOrder = $(this).data("sortorder");
        var sortBy = tempSort;
        var sortOrder = tempOrder;
        var page = $("#pageNumber").val();
        $.ajax({
            url: "payout-buyer-sort",
            data: {sortBy: sortBy, sortOrder:sortOrder, page: page, filter:filter, filterBy:filterBy},
            type: 'get',
            dataType: 'JSON',                      
            success: function(result){
                loader.hidePleaseWait(); 
                $("#tbody").html(result.html);
            }
        });      
    });            

    $(document.body).on('click','.checkShipping',function (e) {  
        var $this = $(this);
        var $orderProduct = $this.data('order-product-id');
        var $url = '/payout/seller/view-transaction-shipping';
        var $request = $.ajax({
                url: $url,
                data:{order_product_id:$orderProduct},
                type: 'get',
                dataType: 'JSON',
                success: function(result){
                    var modal_container = $('<div></div>');
                    modal_container.append(result.html);
                    loader.hidePleaseWait();
                    BootstrapDialog.show({
                        title: 'Shipping Details',
                        message: modal_container,
                        cssClass: 'payment-dialog',
                        buttons: [
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
        if(tag != "0") {
            var $confirm = confirm("Are you sure you want to update?");
            var sellerId =  $('#sellerID').val();
            $('.orderProductId').each(function(){
                orderProductIdCollection.push( parseInt($(this).html().trim(), 10));
            }); 
            if($confirm){
                $.ajax({
                    url: "payout-buyer/update-buyer-transaction",
                    data: {order_product_ids: orderProductIdCollection, tagId:tag, sellerId: sellerId},
                    type: 'get',
                    dataType: 'JSON',                      
                    success: function(result){
                        window.location.href = location.href;
                    }
                });
            }   
        }



       
    });
    
})(jQuery);

