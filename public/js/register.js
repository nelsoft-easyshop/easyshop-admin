(function () {

    $( "#form" ).on( "submit", function( event ) {

        event.preventDefault();
        data = $( this ).serialize() + "&_method=put";
        register(data);
    });

    $("#rolesDiv").on('click','#toggleMe',function () {         
        var adminId = $(this).data('admin');

        $(this).closest('.btn-toggle').find('.btn').toggleClass('active');  
        
        if ($(this).closest('.btn-toggle').find('.btn-primary').size()>0) {
           $(this).closest('.btn-toggle').find('.btn').toggleClass('btn-primary');
        }
        var text = $(this).closest('.btn-toggle').find('.active').text();
        var IsActive = text == "Enabled" ? 1 : 0;

        $.ajax({
            type: 'post',
            dataType: 'JSON', 
            url: "/register/adminactivation",
            data:{_method: 'put', adminid:adminId, activation:IsActive},
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

    $('.admin_detail').click(function(){
        loader.showPleaseWait();
        var $this = $(this);
        var userId = $this.data("id");

        $.ajax({
            type: 'post',
            dataType: 'JSON', 
            url: "/register/getadminaccount",
            data: {userId:userId, _method:"put"},
            success: function(json) {
                loader.hidePleaseWait();
                var modal_container = $('<div class="order_product"></div>');
                modal_container.append(json.html);
                BootstrapDialog.show({
                    title: "Reset Password",
                    message: modal_container,
                    cssClass: 'account-dialog',
                });
            },
            error: function(e) {
                loader.hidePleaseWait();   
            }
        }); 
        loader.hidePleaseWait();
    });

    $(document.body).on('click','#updateBtn', function(e){

        var password = $("#editPassword").val().trim();
        var id = $(this).data("id");


        if(password === "") {
            $("#editPassword").css("border-color","red");
        }
        else {
            $(".bootstrap-dialog-close-button").trigger("click");
            loader.showPleaseWait();   
            $.ajax({
                type: 'post',
                dataType: 'JSON', 
                url: "/register/resetPassword",
                data: {id:id, password:password, _method:"put"},
                success: function(json) {
                    loader.hidePleaseWait();
                },
                error: function(e) {
                    loader.hidePleaseWait();                     
                }
            }); 
        }

    });

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
            url: "/register/adminroles",
            data:data,
            success: function(json) {
                if(json[0] == true) {
                     loader.hidePleaseWait();                     
                 }
            },
            error: function(e) {
                showErrorModal("<h4>Something went wrong, please try again</h4>");                
                loader.hidePleaseWait();   
            }
        }); 

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
                                errors += "<br/><h4>" + json.errors[i] + "</h4>";
                            }
                        });
                        errors = errors.replace("undefined","");
                        $("#changeTextError").html(errors);
                        $("#error").modal('show');  
                        $("#loading").modal('hide');

                   
                    }
                }

                $("#rolesDiv").load('register/managerole'); 
            },
            error: function(e) {
                 $("#error").modal('show');  
                 $("#loading").modal('hide');
            }
        });
        $("#inputUsername").val("");
        $("#inputPassword").val("");
        $("#inputFullname").val("");
    }    

})(jQuery);
