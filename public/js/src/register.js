(function () {


    $( "#form" ).on( "submit", function( event ) {

        event.preventDefault();
        data = $( this ).serialize();
        register(data);
    });

    function register(data) {
        var errors;
        $("#loading").modal('show');

        $.ajax({
            type: 'post',
            url: "/register",
            data:data,
            success: function(json) {
                if(json == "success") {
                    $("#success").modal('show');  
                    $("#loading").modal('hide');
                    $("#rolesDiv").load('managerole');                         
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
            },
            error: function(e) {
                 $("#error").modal('show');  
                 $("#loading").modal('hide');
            }
        });
    }

})(jQuery);