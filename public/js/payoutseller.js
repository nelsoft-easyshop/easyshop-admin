(function ($) {

    var updateStatus = function(order_id,member_id,tag_type,$rowStatus,dialogRef){
        var $variable = "true";
        if(tag_type != "0"){
            var $url = '/payout/seller/update-transaction';
            var $confirm = confirm("Are you sure you want to update?");
            if($confirm){
                var $request = $.ajax({
                        url: $url,
                        data:{order_id:order_id,member_id:member_id,tag_type:tag_type},
                        type: 'get',
                        dataType: 'JSON',
                        success: function(result){
                            console.log(result);
                            if(result.isSuccess){
                                if($tagType == $("#confirmed-constant").val() || $tagType == $("#refund-constant").val()){
                                    window.location = '/payout/seller';
                                }

                                $tagColor = $("#tagType option:selected").data('color');
                                $rowStatus.html('<span class="org_btn view" style="background-color:'+$tagColor +'" >'+$("#tagType option:selected").html()+'</span>');
                                dialogRef.close();
                            }
                            else{
                                alert(result.message);
                            }
                        }
                    });
            }
        }  
    }


    var addShipping = function(dialogRef){
        var $orderProductId = $("#order-product-id").val();
        var $courier = $("#courier").val();
        var $tracking = $("#tracking").val();
        var $comment = $("#shipping-comment").val();
        var $delivery = $("#delivery-date").val();
        var $expected = $("#expected-date").val();
        var $url = "/shippingdetails/add";
        var $request = $.ajax({
                            type: "get",
                            url: $url,
                            data: {
                                    order_product_id:$orderProductId
                                    ,courier:$courier
                                    ,tracking:$tracking
                                    ,comment:$comment
                                    ,delivery:$delivery
                                    ,expected:$expected
                                },
                            success: function(data){ 
                                if(data.isSuccess){
                                    $("#divSpan"+$orderProductId).html('<span data-order-product-id="'+$orderProductId+'" class="org_btn view checkShipping"> View Shipping Details</span>');
                                    dialogRef.close();
                                }
                                else{
                                    alert(data.message);
                                }
                            }
                        });
    }

    $('.seller_detail').click(function(){
        loader.showPleaseWait();
        var $this = $(this);
        var $url = '/payout/seller/view-transactions-details'; 
        var $orderId = $this.find('.td_order_id').html(); 
        var $memberId = $this.find('.td_username').data('member-id'); 
        var $rowStatus = $this.find('.td_status');
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
                                cssClass: 'btn-primary',
                                action: function(dialogRef) {
                                    $tagColor = $("#tagType option:selected").data('color');
                                    $tagType = $("#tagType").val();
                                    updateStatus($orderId,$memberId,$tagType,$rowStatus,dialogRef);
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
 
    $(document.body).on('click','.addShipping',function (e) {
        var $this = $(this);
        var $orderProduct = $this.data('order-product-id');
        var $url = '/payout/seller/add-transactions-details';
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
                        title: 'Add Shipping Details For Order Product '+$orderProduct,
                        message: modal_container,
                        cssClass: 'payment-dialog',
                        buttons: [
                            {
                                label: 'Save',
                                cssClass: 'btn-primary',
                                action: function(dialogRef) {
                                    addShipping(dialogRef);
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

    $('.drct_search').on('click', function(){
        var id = $(this).attr('data');
        var text = $('#searchBox').val();
        $('#' + id).val(text);
        $('#searchForm').submit();
    });

    $(".tag_search").on('click', function(){
        var id = $(this).attr('data');
        var value = $(this).attr('data-value');
        $('#' + id).val(value);
        $('#searchForm').submit();
    });

    $(".tag_default").on('click', function(){
        window.location = '/payout/seller';
    });
})(jQuery);

