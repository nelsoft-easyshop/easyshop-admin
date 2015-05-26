(function () {

    
    var userid, hash, urlLink;
    $(document).ready(function(){
        userid = $(".userid").html();       
        urlLink = $("#webServiceLink").val();
        
        var requestData = {
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(responseHash) {            
            hash = responseHash;
        });

    });

    $("#uploadImageOnly").fileinput({
        previewFileType: ['image'],
        'showUpload':true,
    });

    $('#success').bind('hidden.bs.modal', function () {
        window.location.href = location.href;  
    });


    $("button:nth-child(2)").attr('id', 'uploadPhotosSubmit');      
    $(document.body).delegate('#uploadPhotosSubmit', 'click', function(event) {
        var maxDimensions = 5000;
        var maxFileSize = 5;
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
                if(file.size > (maxFileSize*1000000) || 
                  (file.width > maxDimensions || file.height > maxDimensions)) {
                    proceed = 0;
                    showErrorModal("Failed to upload Image<br/><br/>Max image dimensions: "+maxDimensions+"px x "+maxDimensions+"px<br/>Max Image Size: "+maxFileSize+" MB");
                }
            }
        }
        if(proceed == 1) {
            $("#uploadphoto").find("#hash").val(hash);            
            loader.showPleaseWait();
            submitPhotos();
        }
        event.preventDefault();
    });

    $("#profile").on("click","#removeAdminImage", function() {
        loader.showPleaseWait();

        var $this = $(this);
        var imageId = $this.data("imageid");
        var imageName = $this.data("imagename");
        
        var requestData = {
            imageId: imageId,
            imageName: imageName,            
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            
            requestData.hash = hash;            
            $.ajax({
                url : urlLink + "/deleteImage",
                type: 'GET', 
                dataType: 'jsonp',
                data: requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                success:function(data, textStatus, jqXHR) 
                {
                    loader.hidePleaseWait();  
                    $("#success").modal("show");  
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    loader.hidePleaseWait();
                    showErrorModal("Something went wrong, please try again");
                }
            });

        });


    });

    $('#uploadData').ajaxForm({
        url: 'productcsv',
        type: 'post', 
        dataType: 'json', 
        beforeSubmit: function(event) {
            loader.showPleaseWait();
            var files = $('#uploadCSV').prop("files");
            if(files.length < 1) {
                loader.hidePleaseWait();
                showErrorModal("Please upload a file");
                return false;
            }
        },
        success: function(json) { 
            if(json.error && typeof json.error[0].dataNotFound !== "undefined") {
                var errorString = "";
                $.each(json.error[0].dataNotFound , function( index, obj ) {
                    errorString += "<h4 style='padding-top:5px;'>" + obj + "</h4>";
                });                  
                $( "input#productIds" ).remove();
                loader.hidePleaseWait();                  
                showErrorModal(errorString);
            }          
            else if(typeof json.html !== "undefined"){
                $.each(json.html[0] , function( index, obj ) {
                    $.each(obj, function( key, value ) {
                        $("#sendToWebservice").append('<input type="hidden" name="product[]" class = "removeme" id="productIds" value="' + value +'"/>');                
                    });
                });     
                submitToWebService();
            }
            else {
                showErrorModal("Error in CSV File");                                        
                $( "input#productIds" ).remove();
                loader.hidePleaseWait();                   
            }

        },
        error: function(e) {
            showErrorModal("Error in CSV File");                                        
            $( "input#productIds" ).remove();
            loader.hidePleaseWait(); 
        }
    }); 
    
    $(document.body).delegate('#uploadData', 'submit', function(event) {
        event.preventDefault();

    });

    function submitPhotos(){
        $("#uploadphoto").ajaxForm({
                url: urlLink,
                type: 'GET', 
                dataType: 'jsonp',
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

        $("#sendToWebservice").append('<input type="hidden" name="userid" id="userid" value="' + userid +'"/>');                
        $("#sendToWebservice").append('<input type="hidden" name="hash" id="hash" value="' + hash +'"/>');                
        $("#sendToWebservice").submit(function(event)
        {
            event.preventDefault();
            var postData = $(this).serializeArray();
            if(postData.length < 1) {
                loader.hidePleaseWait();
                showErrorModal("Error Occured. Kindly check for missing data in your excel files");
                return false;
            }
            else {
                $.ajax(
                {
                    url : urlLink,
                    type: 'GET', 
                    dataType: 'jsonp',
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
            }
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
