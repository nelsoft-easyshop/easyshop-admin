(function () {

    $("#uploadImageOnly").fileinput({
        previewFileType: ['image'],
        'showUpload':true,
    });
    $('#success, #customerror').bind('hidden.bs.modal', function () {
            window.location.href = location.href;  
    })  


    $(document.body).delegate('#uploadphoto', 'submit', function(event) {
        loader.showPleaseWait();
        if($("#uploadImageOnly").val() == "")   {
            loader.hidePleaseWait();

            showErrorModal("Please select a file to upload");
            $("#success").css("display","none");
        }
        event.preventDefault();

     
    });

    $('#uploadData').ajaxForm({
        url: 'productcsv',
        type: 'post', 
        dataType: 'json',            
        success: function(json) { 
        $.each(json.html , function( index, obj ) {
            $.each(obj, function( key, value ) {
                $("#sendToWebservice").append('<input type="hidden" name="product[]" class = "removeme" id="productIds" value="' + value +'"/>');                
            });
        });            

            submitToWebService();
        },
        error: function(e) {
            showErrorModal("Error in CSV File");                                        
            $( "input#productIds" ).remove();
            loader.hidePleaseWait();             
        }
    }); 
    
    $("#uploadphoto").ajaxForm({
        url: "https://easyshop.ph.local/webservice/synccsvImage",
        type: 'GET', 
        dataType: 'jsonp',
        async: false,
        jsonpCallback: 'jsonCallback',
        contentType: "application/json",
        dataType: 'jsonp',
        success: function(json) {
            loader.hidePleaseWait();             
            $("#success").modal("show");   
        },
        error: function(e) {
            loader.hidePleaseWait();             
            $("#success").modal("show");
        }
    }); 

    $(document.body).delegate('#uploadData', 'submit', function(event) {
        loader.showPleaseWait();   
        event.preventDefault();

    });


    function submitToWebService(){

       $("#sendToWebservice").submit(function(event)
        {
            event.preventDefault();
            var postData = $(this).serializeArray();
            $.ajax(
            {
                url : "https://easyshop.ph.local/webservice/synccsvImage",
                type: 'GET', 
                dataType: 'jsonp',
                async: false,
                data: postData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                success:function(data, textStatus, jqXHR) 
                {
                    loader.hidePleaseWait();  
                    if(data.sites[0].success != "success") {
                        showErrorModal(data.sites[0].success);                                     
                        $( "input#productIds" ).remove();
                    }
                    else {
                        $("#success").modal('show');                                         
                    }


                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    loader.hidePleaseWait();

                    $( "input#productIds" ).remove();                                          
                }
            });


        });
         
        $("#sendToWebservice").submit(); 
        $("#sendToWebservice").unbind();
    }

    function showErrorModal(messages) {
            $("#success").modal('hide');  
            $("#errorTexts").html(messages); 
            $("#customerror").modal('show');  
        }

})(jQuery);
