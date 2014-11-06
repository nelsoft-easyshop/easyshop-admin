(function ($){
    $(document).ready(function() {
         $('.date').each(function() {
            $(this).datetimepicker({
                timepicker:false,
                format:'Y/m/d'
            });
        });
    });
})(jQuery)