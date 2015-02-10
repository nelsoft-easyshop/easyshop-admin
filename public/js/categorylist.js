(function ($){
    var mdl_button = $('#mdl_save');
    var mdl_name = $('#mdl_name');
    var mdl_description = $('#mdl_description');
    var mdl_keyword = $('#mdl_keyword');
    var mdl_sort = $('#mdl_sort');
    var mdl_main = $('input:radio[name=mdl_main]');
    var mdl_title = $('#mdl_title');

    $('#date_timepicker_start').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
            })
        },
        timepicker:false
    });
    $('#date_timepicker_end').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
            })
        },
        timepicker:false
    });
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

    $('.redirect').on('click', function()
    {
        var id = $(this).parent().attr('data');
        if(id != 1){
            id = '?id=' + id;
        }else{
            id = '';
        }
        window.location = '/category' + id ;
    });

    $('#myModal').on('click','#mdl_save',function()
    {
        var cat_id = $(this).attr('data');
        var parent_id = $('.active').attr('data');
        var cat_name = mdl_name.val().trim();
        var cat_description = mdl_description.val().trim();
        var cat_keyword = mdl_keyword.val().trim();
        var cat_sort = mdl_sort.val().trim();
        var cat_main =  mdl_main.filter(':checked').val();
        if( cat_name === ''){
            alert('Invalid Name.');
            return false;
        }else if(cat_sort === 0){
            alert('Invalid Sort.');
            return false;
        }
        loader.showPleaseWait();
        if($(this).attr('todo') === 'update'){
            update(
                cat_id,
                cat_name,
                cat_description,
                cat_keyword,
                cat_sort,
                cat_main
            );
        }else if($(this).attr('todo') === 'save'){
            add(
                parent_id,
                cat_name,
                cat_description,
                cat_keyword,
                cat_sort,
                cat_main
            );
        }
        loader.hidePleaseWait();
    });


    $(document).on('click', '.edit_btn', function()
    {
        var id = $(this).attr('data_id');
        var data_obj = $('#tbl-cat-list #data_'+id).attr('data');
        PushObjectToFields(data_obj);
        mdl_button.html('Save changes');
        mdl_button.attr('todo', 'update');
    });

    $('#create_cat').on('click', function()
    {
        clearFields();
        mdl_title.html('<span class="glyphicon glyphicon-plus"></span> ADD CATEGORY');
        mdl_button.html('Save').attr('todo', 'save');
    });

    function PushObjectToFields(data_obj)
    {
        var data = $.parseJSON( data_obj);
        mdl_title.html('<span class="glyphicon glyphicon-edit"></span> EDIT CATEGORY INFORMATION');
        mdl_name.val(data.name);
        mdl_description.val(data.description);
        mdl_keyword.val(data.keywords);
        mdl_sort.val(data.sort_order);
        mdl_button.attr('data',data.id_cat);
        $('#chck_no').prop("checked", true);
        if(parseInt(data.is_main) === 1) {
            $('#chck_yes').prop("checked", true);
        }
    }

    function pushJsonToFields(todo,data_json)
    {
        var id = escapeHtml(data_json.id_cat);
        var html = '';
        var obj = '{"id_cat":"' + id +
            '","name":"' + escapeHtml(data_json.name) +
            '","description":"' + escapeHtml(data_json.description) +
            '","keywords":"' + escapeHtml(data_json.keywords) +
            '","sort_order":"' + escapeHtml(data_json.sort_order) +
            '","is_main":"' + escapeHtml(data_json.is_main) + '"}';
        if(todo == 'update'){
            $('.tbl-my-style #' + id + '_name').html(escapeHtml(data_json.name));
            $('.tbl-my-style #' + id + '_description').html(escapeHtml(data_json.description));
            $('.tbl-my-style #' + id + '_keywords').html(escapeHtml(data_json.keywords));
            $('.tbl-my-style #' + id + '_sort_order').html(escapeHtml(data_json.sort_order));
            $('.tbl-my-style #' + id + '_is_main').html(escapeHtml(data_json.is_main));
            $('.tbl-my-style #data_' + id ).attr('data',obj);
        }else{
            html += '<tr data="'+ id +'">';
            html += '<td>';
            html += '<div class="btn-toolbar" role="toolbar">';
            html += '<div class="btn-group">';
            html += '<button class="btn btn-danger edit_btn" data_id="'+ id +'" data-target="#myModal" data-toggle="modal" type="button">';
            html += '<span class="glyphicon-center glyphicon glyphicon-cog"></span>';
            html += "<span id='data_"+ id +"' class='data_container' data="+ obj +" > </span>";
            html += '</button>';
            html += '</div>';
            html += '</div>';
            html += '</td>';
            html += '<td class="redirect">10-24-1991 06:30:05</td>';
            html += '<td id="'+ id +'_sort_order" class="redirect">'+ data_json.sort_order +'</td>';
            html += '<td id="'+ id +'_name" class="redirect">'+ data_json.name +'</td>';
            html += '<td id="'+ id +'_description" class="redirect">'+ data_json.description +'</td>';
            html += '<td id="'+ id +'_keywords" class="redirect">'+ data_json.keywords +'</td>';
            html += '<td id="'+ id +'_is_main" class="redirect">'+ data_json.is_main +'</td>';
            html += '<td class="redirect">'+ data_json.slug +'</td>';
            html += '</tr>';
            $('#tbl-cat-list tbody').append(html);
        }
    }

    function CloseBootstrapModal()
    {
        $('.modal.in').modal('hide');
    }

    function clearFields()
    {
        mdl_title.html('');
        mdl_name.val('');
        mdl_description.val('');
        mdl_keyword.val('');
        mdl_sort.val('');
        mdl_button.attr('data','');
    }

    function add(parent_id, cat_name, cat_description, cat_keyword, cat_sort, cat_main)
    {
        if(typeof (parent_id) == 'undefined'){
            parent_id = 1;
        }

        $.ajax({
            url:'/category/categoryAdd',
            dataType:'JSON',
            type:'POST',
            data:{
                _method:'put',
                parent_id:parent_id,
                name:cat_name,
                description:cat_description,
                keywords:cat_keyword,
                sort_order:cat_sort,
                is_main:cat_main},
            success:function(result){
                pushJsonToFields('insert', result);
                CloseBootstrapModal();
            }
        })
    }
    function update(cat_id, cat_name, cat_description, cat_keyword, cat_sort, cat_main)
    {
        $.ajax({
            url:'/category/categoryUpdate',
            dataType:'JSON',
            type:'POST',
            data:{
                _method:'put',
                id_cat:cat_id,
                name:cat_name,
                description:cat_description,
                keywords:cat_keyword,
                sort_order:cat_sort,
                is_main:cat_main},
            success:function(result){
                pushJsonToFields('update', result);
                CloseBootstrapModal();
            }
        })
    }

})(jQuery)
