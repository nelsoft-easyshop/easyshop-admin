(function () {

    var globalUserId = $('#userIdSpan').html();
    var globalPassword = $('#adminPasswordSpan').html();

    $("#manageSelectDiv").on('click','#submitSelect',function () {     
        
        var checkuser = $(this).data('checkuser');
        var url = $(this).data('url');
        var value = $(this).closest("form").find("#value").val();
        var id = $(this).closest("form").find("#id").val();
        var password = globalPassword;
        var userid = globalUserId;
        var hash =  hex_sha1(value + userid + id + password);

        if(value == "") {
            $("#error").modal('show');
        }
        else {
            data = { value:value, userid: userid, id:id, hash:hash, checkuser:checkuser, callback:'?' };
            $(this).closest("form").find("#value").val(value);
            setSelectNode(data,url);             
        }
    });
    
    
    function setSelectNode(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');

                if(json.sites[0]["success"] != "success") {

                    if(json.sites[0]["usererror"]){
                        $("#errorTexts").html(json.sites[0]["usererror"]);
                    }
                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');     
                }
                else {
                    $("#success").modal('show');                   
                }                     
            },
            error: function(e) {
                $("#loading").modal('hide');                                
                $("#error").modal('show');
  
            }
        });
    }

})(jQuery);


