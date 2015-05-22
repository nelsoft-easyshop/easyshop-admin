
(function ($) {
    $(document).ready(function(){
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

        $('#btn_advance_search').on('click',function(){
            $('#srch_container').slideDown();
        });
        $('#btn_close_search').on('click',function(){
            $('#srch_container').slideUp();
        });

        $('.search-string').each(function(){
            if($(this).val()){
                $('#srch_container').slideDown();
                return false;
            }
        });
        $('#searchBox').val($('#single_search').val());
    });

    $('.drct_search').on('click', function(){
        var id = $(this).attr('data');
        var text = $('#searchBox').val().trim();
        if(text === ""){
            alert('Please input a word to search for.');
            return false;
        }
        $('.search-string').each(function(){
            $(this).val('');
        });
        $('#single_search').val(text);
        $('#' + id).val(text);
        $('#searchForm').submit();
    });
})(jQuery)
