
(function ($) {
    $(document).ready(function(){
        $('#btn_advance_search').on('click',function(){
            $('#srch_container').slideDown();
        });
        $('#btn_close_search').on('click',function(){
            $('#srch_container').slideUp();
        });
    });
})(jQuery)
