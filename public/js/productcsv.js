$(document).ready(function () {
    var success = getParameterByName('success');
    if(success == 1){
        $("#success").modal("show");
    }

    $("#uploadImageOnly").fileinput({
        previewFileType: ['image'],
        
    });

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
    
    
}); 
