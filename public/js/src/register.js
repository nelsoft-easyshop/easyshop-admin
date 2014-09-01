(function () {

    $( "#form" ).on( "submit", function( event ) {

        event.preventDefault();
        data = $( this ).serialize() + "&_method=put";
        register(data);
    });

    function register(data) {
        var errors;
        $("#loading").modal('show');

        $.ajax({
            type: 'post',
            dataType: 'JSON', 
            url: "/register",
            data:data,
            success: function(json) {
                if(json == "success") {
                    $("#success").modal('show');  
                    $("#loading").modal('hide');
                        
                }
                else {
                    if((json.errors.username) != null || (json.errors.password) != null || (json.errors.fullname) != null) {

                        $.each(json.errors, function (i, v) {
                            if(json.errors[i] != "undefined") {
                                errors += "<h4>" + json.errors[i] + "</h4>";
                            }
                        });
                        errors = errors.replace("undefined","");
                        $("#changeTextError").html(errors);
                        $("#error").modal('show');  
                        $("#loading").modal('hide');
                   
                    }
                }

                $("#rolesDiv").load('managerole'); 
            },
            error: function(e) {
                 $("#error").modal('show');  
                 $("#loading").modal('hide');
            }
        });
    }


    $("#rolesDiv").on('click','#rolesLink',function (e) { 

        var role = $(this).data('role');
        var adminId = $(this).data('id');
        var index = $(this).data('index');
        var roleid = $(this).data('roleid');
        var action = $(this).data('action');
        var selector = "#action" + action;
        loader.showPleaseWait();   
        $(selector).text(role);
        data = {_method: 'put', adminid:adminId, roleid:roleid};
        $.ajax({
            type: 'post',
            dataType: 'JSON', 
            url: "adminroles",
            data:data,
            success: function(json) {
                if(json[0] == true) {
                     loader.hidePleaseWait();                     
                 }
            },
            error: function(e) {
                loader.hidePleaseWait();   
            }
        }); 

    });    

})(jQuery);
