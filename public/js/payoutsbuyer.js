(function ($) {

    var forBuyer = 1;

    var updateStatus = function(order_id,member_id,tag_type,$rowStatus,forBuyer,dialogRef){

        var checkValues = $('input[name=order-id-checkbox]:checked').map(function(){
            return $(this).val();
        }).get();

        var $variable = "true";
        if(tag_type != "0"){
            var $url = '/contact/seller/update-transaction'; 
            var $tagColor = $("#tagType option:selected").data('color');
            var $statusList = $("#nonDefaultStatus").val();
            var $currentCount = parseInt($rowStatus.children('.count-tag').html());
            var $totalCount = parseInt($rowStatus.children('.total-tagged').html());
            
            BootstrapDialog.confirm('Are you sure you want to update?', function(result){
                if(result) {
                    var $request = $.ajax({
                        url: $url,
                        data:{
                                order_id:order_id,
                                member_id:member_id,
                                tag_type:tag_type,
                                order_product_ids:checkValues,
                                forBuyer:forBuyer
                            },
                        type: 'get',
                        dataType: 'JSON',
                        success: function(result){
                            if(result.isSuccess){
                                if($tagType == $("#confirmed-constant").val() || $tagType == $("#refund-constant").val() || $tagType == $("#payout-constant").val()){
                                    var $newCurrentCount = $currentCount;
                                    var $newCurrentCountTotal = $currentCount;
                                    $(".check-box-order-product:checked").each(function() {
                                        var $this = $(this);
                                        $(".tdrow-"+$this.data('orderproductid')).closest('tr').remove();
                                        $rowStatus.children('.total-tagged').html($currentCount -= 1);
                                        $rowStatus.children('.count-tag').html($newCurrentCountTotal -= 1);
                                    });
                                    if(parseInt($rowStatus.children('.total-tagged').html()) <= 0){
                                        $rowStatus.closest('tr').remove();
                                        dialogRef.close();
                                        window.location = '/contact/seller';
                                    }
                                }
                                else{
                                    var $newCurrentCount = $currentCount;
                                    $(".check-box-order-product:checked").each(function() {
                                        var $this = $(this);
                                        $this.data('tagid',$tagType);
                                        $this.data('status',JSON.parse($statusList));
                                        $this.attr('checked', false);
                                        $(".tdrow-"+$this.data('orderproductid')).empty().append('<span class="org_btn view" style="background-color:'+$tagColor +'" >'+$("#tagType option:selected").html()+'</span>');
                                        
                                        if($tagType == $("#contacted-constant").val()){
                                            $rowStatus.children('.count-tag').html($newCurrentCount += 1);
                                        }
                                    });
                                }
                                $("#tagType").empty();
                                $("#tagType").append('<option value="0">--Select Tag--</option>');
                            }
                            else{
                                var $message = result.message;
                                BootstrapDialog.show({
                                    type: BootstrapDialog.TYPE_DANGER,
                                    message:$message
                                });
                            }
                        }
                    });
                }
            }); 
        }  
    }


    var addShipping = function(dialogRef){
        var $orderProductId = $("#order-product-id").val();
        var $courier = $("#courier").val();
        var $tracking = $("#tracking").val();
        var $comment = $("#shipping-comment").val();
        var $delivery = $("#delivery-date").val();
        var $expected = $("#expected-date").val();
        var $url = "/contact/shippingdetails/add";
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
                                    var $message = data.message;
                                    BootstrapDialog.show({
                                        type: BootstrapDialog.TYPE_DANGER,
                                        message:$message
                                    });
                                }
                            }
                        });
    }

    var checkTagAvailable = function(){
        var $isAvailable = true;
        var $tags = null;
        var $tagArray = [];
        $(".check-box-order-product:checked").each(function() {
            $tagArray.push($(this).data('tagid'));
            $tags = $(this).data('status');
        });

        $isAvailable = $tagArray.areArraysEquals();
        $("#tagType").empty();
        $("#tagType").append('<option value="0">--Select Tag--</option>');
        if($isAvailable){
            $.each( $tags, function( index, value ){ 
                $("#tagType").append("<option value='"+value.id_tag_type+"' data-color='" +value.tag_color+"' > " +value.tag_description + "</option>");
            });
        }
    }

    $('.seller_detail').click(function(){

        loader.showPleaseWait();
        var $this = $(this);
        var $url = '/contact/seller/view-transactions-details/'; 
        var $orderId = $this.find('.td_order_id').html(); 
        var $memberId = $this.find('.td_username').data('member-id'); 
        var $rowStatus = $this.find('.td_status');
        var $currentTag = $("#currentTag").val();
        var $contactedTag = $("#contacted-constant").val();
        var $request = $.ajax({
                url: $url,
                data:{
                        order_id:$orderId,
                        member_id:$memberId,
                        current_tag:$currentTag,
                        forBuyer:forBuyer
                    },
                type: 'get',
                dataType: 'JSON',
                success: function(result){
                    var modal_container = $('<div></div>');
                    modal_container.append(result.html); 
                    loader.hidePleaseWait();
                    if($currentTag == "" || $currentTag == $contactedTag){
                        BootstrapDialog.show({
                            title: 'History Information',
                            message: modal_container,
                            cssClass: 'payment-dialog',
                            buttons: [
                                {
                                    label: 'Back',
                                    action: function(dialogRef) {
                                        dialogRef.close();
                                    }
                                },
                                {
                                    label: 'Save',
                                    cssClass: 'btn-primary',
                                    action: function(dialogRef) {
                                        $tagColor = $("#tagType option:selected").data('color');
                                        $tagType = $("#tagType").val();
                                        updateStatus($orderId,$memberId,$tagType,$rowStatus,forBuyer,dialogRef);
                                    }
                                }
                            ],

                        });
                    }
                    else{
                        BootstrapDialog.show({
                            title: 'History Information',
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
                }
            });
    });

    $(document.body).on('click','.check-box-order-product',function (e) { 
        checkTagAvailable();
    });

    $(document.body).on('focus', "#tagType", function () {
        checkTagAvailable();
    });

    $(document.body).on('click','.checkShipping',function (e) {  
        var $this = $(this);
        var $orderProduct = $this.data('order-product-id');
        var $url = '/contact/seller/view-transaction-shipping';
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
        var $url = '/contact/seller/add-transactions-details';
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
                                label: 'Back',
                                action: function(dialogRef) {
                                    dialogRef.close();
                                }
                            },
                            {
                                label: 'Save',
                                cssClass: 'btn-primary',
                                action: function(dialogRef) {
                                    addShipping(dialogRef);
                                }
                            }
                        ]
                    });
                }
            });
    });

    $('.drct_search').on('click', function(){
        var id = $(this).attr('data');
        var searchBox = $('#searchBox');
        var text = searchBox.val().trim();
        searchBox.val('');
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
        window.location = '/contact/buyer';
    });
})(jQuery);

