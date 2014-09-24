$(document).ready(function () {
    var success = getParameterByName('success');
    if(success == 1){
        $("#success").modal("show");
    }

    $("#uploadImageOnly").fileinput({
        previewFileType: ['image'],
        
    });
    $('#uploadData').ajaxForm({
        url: 'productcsv',
        type: 'post', 
        dataType: 'json',            
        success: function(json) { 
        
            $.each(json.html, function (i, v) {
                $("#sendToWebservice").append('<input type="text" name="product[]" class = "removeme" id="productIds" value="' + json.html[i] +'"/>');                
            });
            submitToWebService();
        },
        error: function(e) {
            alert("Error CSV");
            loader.hidePleaseWait();             
        }
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
                    $( "input#productIds" ).remove();
                    //alert(data.sites[0]["success"]);
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    loader.hidePleaseWait();                      
                    //alert("error");
                }
            });


        });
         
        $("#sendToWebservice").submit(); //Submit  the FORM
        $("#sendToWebservice").unbind();
    }

    $(document).delegate('#uploadData', 'submit', function(event) {
        loader.showPleaseWait();   
        event.preventDefault();

    });


/*
    $(document).delegate('#uploadphoto', 'submit', function(event) {
        loader.showPleaseWait();   
        event.preventDefault();

    });

    $("#uploadphoto").ajaxForm({
        url: "https://easyshop.ph.local/webservice/productimages",
        type: 'GET', 
        dataType: 'jsonp',
        async: false,
        jsonpCallback: 'jsonCallback',
        contentType: "application/json",
        dataType: 'jsonp',
        success: function(json) {
            window.location.href = location.href + "?success=1";                     
        },
        error: function(e) {
            window.location.href = location.href + "?success=1";     

        }
    }); 
    */
    
}); 
