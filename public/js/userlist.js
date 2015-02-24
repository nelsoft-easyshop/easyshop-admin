
(function ($) {
    var mdl_fullname = $('#mdl_fullname');
    var mdl_contact = $('#mdl_contact');
    var mdl_remarks = $('#mdl_remarks');
    var mdl_promo = $('input:radio[name=mdl_promo]');
    var mdl_button = $('#mdl_save');
    var dp1 = $('[name^=c_stateregion]');
    var dp2 = $('[name^=c_city]');
    var mdl_address = $('#mdl_address');
    var $mdl_ban = $('input:radio[name=mdl_ban]');
    var $select_div = $('#ban_dropdown');
    var $select_ban = $('#ban_select');
    var jsonCity = $.parseJSON($('#jsonData').attr('data'));

    $(document).ready(function()
    {
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

        $mdl_ban.on('change', function ()
        {
            var $this = $(this);
            var checkedOpt = $this.filter(':checked');

            if (parseInt(checkedOpt.val()) === 1) {
                $select_div.show();
            }
            else {
                $select_ban.val('0')
                $select_div.hide();
            }
        });

        $('#btn_advance_search').on('click',function()
        {
            $('#srch_container').slideDown();
        });

        $('#btn_close_search').on('click',function()
        {
            $('#srch_container').slideUp();
        });

        $('#myModal').on('change','.stateregionselect', function()
        {
            var cityselect = $('#myModal').find('.cityselect');
            cityselect.val(0);
            cityFilter( $(this), cityselect );
        });

        $('#tbl-user-list').on('click','.edit_btn',function()
        {
            var id = $(this).attr('data');
            var data_obj = $('#tbl-user-list #data_'+id).attr('data');
            PushObjectToFields(data_obj);
        });

        $('#myModal').on('click','#mdl_save',function()
        {
            var user_id = $(this).attr('data');
            var user_fullname = mdl_fullname.val().trim();
            var user_contact = mdl_contact.val().trim();
            var user_remarks = mdl_remarks.val().trim();
            var user_promo =  mdl_promo.filter(':checked').val();
            var user_cityID = parseInt(dp2.val());
            var user_stateID = parseInt(dp1.val());
            var user_address = mdl_address.val();
            var user_isBan = parseInt($select_ban.val());
alert(user_isBan);
            return false;
            if( user_cityID === 0 || user_stateID === 0 ){
                alert('Invalid Address.');

                return false;
            }
            loader.showPleaseWait();
            $.ajax({
                url:'/users',
                dataType:'JSON',
                type:'POST',
                data:{
                    _method:'put',
                    id:user_id,
                    fullname:user_fullname,
                    contact:user_contact,
                    remarks:user_remarks,
                    is_promo_valid:user_promo,
                    city:user_cityID,
                    stateregion:user_stateID,
                    address:user_address},
                success:function(result){
                    loader.hidePleaseWait();
                    pushJsonToFields(result);
                    CloseBootstrapModal();
                }
            })
        });

        $('.drct_search').on('click', function(){
            var id = $(this).attr('data');
            var text = $('#searchBox').val().trim();
            $('#' + id).val(text);
            $('#searchForm').submit();
        });
    });

    function cityFilter(stateregionselect,cityselect)
    {
        var stateregionID = stateregionselect.find('option:selected').attr('value');
        var optionclone = cityselect.find('option.optionclone').clone();
        optionclone.removeClass('optionclone').addClass('echo').attr('disabled', false);
        cityselect.find('option.echo').remove();
        if(stateregionID in jsonCity){
            jQuery.each(jsonCity[stateregionID], function(k,v){
                optionclone.attr('value', k).html(v).css('display', 'block');
                cityselect.append(optionclone.clone());
            });
        }
        cityselect.trigger('chosen:updated');
    }

    function pushJsonToFields(data_json)
    {
        var idRegion = (data_json.address !== null) ? escapeHtml(data_json.address.region.id_location) : '';
        var region = (data_json.address !== null) ? data_json.address.region.location : '';
        var idCity = (data_json.address !== null) ? escapeHtml(data_json.address.city.id_location) : '';
        var city = (data_json.address !== null) ?  data_json.address.city.location : '';
        var address =  (data_json.address !== null) ? escapeHtml(data_json.address.address) : '';
        var id = escapeHtml(data_json.id_member);
        var obj = '{"id":"' + id +
            '","fullname":"' + escapeHtml(data_json.fullname) +
            '","contact_number":"' + escapeHtml(data_json.contactno) +
            '","remarks":"' + escapeHtml(data_json.remarks) +
            '","is_promote":"' + escapeHtml(data_json.is_promo_valid) +
            '","c_stateregionID":"' + idRegion +
            '","c_cityID":"' + idCity +
            '","address":"' + address + '"}';
        $('.tbl-my-style #' + id + '_uname').html(escapeHtml(data_json.fullname));
        $('.tbl-my-style #' + id + '_contact').html(escapeHtml(data_json.contactno));
        $('.tbl-my-style #' + id + '_remarks').html(escapeHtml(data_json.remarks));
        $('.tbl-my-style #' + id + '_address').html(city + ' ' + region + ' ' + address);
        $('.tbl-my-style #data_' + id ).attr('data',obj);
    }

    function PushObjectToFields(data_obj)
    {
        var data = $.parseJSON( data_obj);
        mdl_fullname.val(data.fullname);
        mdl_contact.val(data.contact_number);
        mdl_remarks.val(data.remarks);
        mdl_button.attr('data',data.id);
        $('#chck_no').prop("checked", true);
        if(parseInt(data.is_promote) === 1){
            $('#chck_yes').prop("checked", true);
        }
        dp1.attr('data_status',data.c_stateregionID);
        dp2.attr('data_status',data.c_cityID);
        dp1.val(data.c_stateregionID);
        cityFilter( dp1, dp2 );
        dp2.val(data.c_cityID);
        mdl_address.val(data.address);
    }

    function CloseBootstrapModal()
    {
        $('.modal.in').modal('hide');
    }

})(jQuery)
