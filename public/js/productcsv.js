(function () {

    var urlLink = $("#webServiceLink").val();
    $("#uploadImageOnly").fileinput({
        previewFileType: ['image'],
        'showUpload':true,
    });
    $('#success, #customerror').bind('hidden.bs.modal', function () {

            window.location.href = location.href;  
    })  


    $("button:nth-child(2)").attr('id', 'uploadPhotosSubmit');      
    $(document.body).delegate('#uploadPhotosSubmit', 'click', function(event) {
        var files = $('#uploadImageOnly').prop("files");
        var proceed = 1;
        if($("#uploadImageOnly").val() == "")   {
            showErrorModal("Please select a file to upload");
            proceed = 0;
        }
        else {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (!file.type.match('image.*')) {
                    proceed = 0;
                    showErrorModal("Images only are allowed");                                        
                }
            }
        }
        if(proceed == 1) {
            loader.showPleaseWait();
            submitPhotos();
        }
        event.preventDefault();
    });

    $('#uploadData').ajaxForm({
        url: 'productcsv',
        type: 'post', 
        dataType: 'json',            
        success: function(json) { 

            if(json.html){    
                $.each(json.html , function( index, obj ) {
                    $.each(obj, function( key, value ) {
                        $("#sendToWebservice").append('<input type="hidden" name="product[]" class = "removeme" id="productIds" value="' + value +'"/>');                
                    });
                });     
                submitToWebService();
            }
            else if(json.error) {
                showErrorModal("Error in CSV File");                                        
                $( "input#productIds" ).remove();
                loader.hidePleaseWait();        
            }        
            else{
                loader.hidePleaseWait();
                showErrorModal("Product Name/Slug Name: " + json.existing[0].existing + " already exists in the database<br/>**product names and slugs must be unique");

            }

        },
        error: function(e) {
            showErrorModal("Error in CSV File");                                        
            $( "input#productIds" ).remove();
            loader.hidePleaseWait(); 
        }
    }); 
    


    $(document.body).delegate('#uploadData', 'submit', function(event) {
        loader.showPleaseWait();   
        event.preventDefault();

    });

    function submitPhotos(){
        $("#uploadphoto").ajaxForm({
                url: urlLink,
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
            $("#uploadphoto").submit();
    }

    function submitToWebService(){

       $("#sendToWebservice").submit(function(event)
        {
            event.preventDefault();
            var postData = $(this).serializeArray();
            $.ajax(
            {
                url : urlLink,
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
                    showErrorModal("Error Occured. Kindly check for missing data in your excel files"); 
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
