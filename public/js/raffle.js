(function () {
    jQuery.browser = {};

    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }

    $('#poolOfWinners.inputWinners').tokenfield();
    $('#listOfPrices').tokenfield();

    /*Prevent duplicate entry for poolOfWinners entries*/    
    $('#poolOfWinners').on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });  
    
    /*Prevent duplicate entry for listOfPrices entries*/    
    $('#listOfPrices').on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });          


    $(document.body).on('click','#addRaffle',function (e) { 
        var errors;
        if($("#winnerType").val() == "upload") {
            var value = $("#uploadPoolOfWinners").val();
            $('#poolOfWinners.inputWinners').tokenfield('setTokens', value);
        }
        else {
            $('#poolOfWinners.inputWinners').tokenfield('setTokens', "");
        }

        var inputRaffleName = $(this).closest("form").find("#inputRaffleName").val();
        var poolOfWinners = $(this).closest("form").find("#poolOfWinners").val();
        var numberOfWinners = $(this).closest("form").find("#numberOfWinners").val();
        var listOfPrices = $(this).closest("form").find("#listOfPrices").val();
        loader.showPleaseWait();   

        $('#registration_form').ajaxForm({
            url: 'doRaffle',
            type: 'post', 
            dataType: 'json',            
            success: function(json) {  
                loader.hidePleaseWait(); 
                $("#rolesDiv").load('showRaffleList');                   
                $.each(json.errors, function (i, v) {
                    if(json.errors[i] != "undefined") {
                        errors += "<h4>" + json.errors[i] + "</h4>";
                    }
                });
                errors = errors.replace("undefined","");

                $("#changeTextError").html(errors);
                $("#error").modal('show');  

            },
            error: function(e) {
                loader.hidePleaseWait();                 
                $("#changeTextError").html("<h4>Please try again</h4>");
                $("#error").modal('show');                 
            }
        }); 
    }); 

    /*Only accepts numeric input for numberOfWinners field*/
    $("#numberOfWinners").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {

        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });

    $("#registration_form").on('click','.dropdown-menu a',function(){

        var id = $(this).attr("id");
        var text = $(this).text();
        $("#action").text(text);
        $("#winnerType").val(id); 

        $("#divInputWinners .token").remove();
        $("#poolOfWinners").val("");

        if(id == "input") {
            $("#divInputWinners").css("display","block");
            $("#divUploadWinners").css("display","none");   
        }
        else {
            $("#divInputWinners").css("display","none");
            $("#divUploadWinners").css("display","block");
        }

    });

    $(document).on('click','#delete',function(){
        loader.showPleaseWait();            
        var id = $(this).data("id");    
            $.ajax({
                type: 'post',
                url: "deleteRaffle",
                data:{id:id},
                dataType: 'json',
                success: function(json) {
                    loader.hidePleaseWait();    
                    $("#rolesDiv").load('showRaffleList');                 
                },
                error: function(e) {
                    $("#changeTextError").html("<h4>Please try again</h4>");
                    $("#error").modal('show');     
                }
            });
    }); 

    $( "td #winnersDisplay, td #pricesDisplay" ).each(function() {
        $(this).shorten({
            "showChars" :"30",
            "moreText"  : "Show More",
            "lessText"  : "Show Less",
        }); 
    });

})(jQuery);    