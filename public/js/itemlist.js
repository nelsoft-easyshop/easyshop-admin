
jQuery(function(){
    jQuery('#date_timepicker_start').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
            })
        },
        timepicker:false
    });
    jQuery('#date_timepicker_end').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
            })
        },
        timepicker:false
    });
});
(function ($) {
    $(document).ready(function(){
        $('#btn_advance_search').on('click',function(){
            $('#srch_container').slideDown();
        });
        $('#btn_close_search').on('click',function(){
            $('#srch_container').slideUp();
        });
    });

    $('.drct_search').on('click', function(){
        var id = $(this).attr('data');
        var text = $('#searchBox').val();
        $('#' + id).val(text);
        $('#searchForm').submit();
    });
})(jQuery)
