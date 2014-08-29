(function () {

    $(".dropdown-menu a").click(function(e){
        var button = document.getElementById( "action" );

        var role = $(this).data('role');
        var adminId = $(this).data('id');
        var index = $(this).data('index');
        var roleid = $(this).data('roleid');
        var action = $(this).data('action');
        var selector = "#action" + action;
        loader.showPleaseWait();   
        $(selector).text(role);
        data = {adminid:adminId, roleid:roleid};
         $.ajax({
            type: 'POST',
            url: "/adminroles",
            data:data,
            success: function(json) {
                loader.hidePleaseWait();  
            },
            error: function(e) {
                loader.hidePleaseWait();   
            }
        }); 

    });



})(jQuery);