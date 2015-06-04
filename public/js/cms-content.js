(function () {

    var globalUserId = $('#userIdSpan').html();

    $("#manageSelectDiv").on('click','#submitSelect',function () {     
        
        var $this = $(this);
        var $form = $this.closest("form");
        var checkuser = $this.data('checkuser');
        var url = $this.data('url');
        var value = $form.find("#value").val();
        var id = $form.find("#id").val();
        var userid = globalUserId;

        if(value == "") {
                $("#error").modal('show');
        }
        else {            
            var requestData = {
                value:value, 
                id:id, 
                userid: userid
            };
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {            
                requestData.hash = hash;
                requestData.checkuser = checkuser;
                requestData.callback = '?';
                $form.find("#value").val(value);
                setSelectNode(requestData,url);             
            });
        }
    });
    
    
    function setSelectNode(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
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


