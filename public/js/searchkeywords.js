(function ($) {

    $("form").submit({
        return false;
    });
    $( "#searchBox" ).keyup(function() {
        var keyword = $(this).val();
        var order = $("#order").val();
        $.ajax({
            type: 'post',
            url: "/customsearchkeywords",
            data:{keyword:keyword,order:order},
            dataType: 'json',
            success: function(json) {
                $("#table_keywords").html(json.html);
            }
        });           
    });

})(jQuery);    