(function () {

    var userid = $("#userid").val();
    var password = $("#password").val();

    $(document.body).on('click','.btn-danger',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#edit_value").val(data.value);
        $("#edit_type").val(data.type);
        $("#edit_target").val(data.target);
        $("#edit_url").val(data.url);
        $("#edit_boxindex").val(data.boxIndex);
        $("#edit_sectionIndex").val(data.sectionIndex);
        $('#drop_actionType option[value="'+ data.actionType +'"]');
    });  

    $("#myModal").on('click','#mdl_save',function (e) { 
        var value = $("#edit_value").val();
        var type = $("#edit_type").val();
        var target = $("#edit_target").val();
        var url = $("#edit_url").val();
        var boxIndex = $("#edit_boxindex").val();
        var sectionIndex = $("#edit_sectionIndex").val();
        var actionType = $('#drop_actionTypeEdit option:selected').text();
        var order = "";
        var hash = hex_sha1(order + sectionIndex + value + type +  boxIndex + target + actionType  +userid +  password);
        data = {order:order, sectionIndex:sectionIndex, value:value, type:type, boxIndex:boxIndex, target:target,  actionType:actionType, userid:userid , password:password,hash:hash};
        setBoxContent(data, url, boxIndex, sectionIndex, value, type, target, actionType);
    });

    $(document.body).on('click','#addBoxContent',function (e) { 
        var value = $(this).closest("form").find("#value").val();
        var type = $(this).closest("form").find("#type").val();
        var target = $(this).closest("form").find("#target").val();
        var url = $(this).data('url');
        var sectionIndex = $(this).closest("form").find("#index").val();
        var actionType = $(this).closest("form").find("#drop_actionType option:selected").text();
        var hash = hex_sha1(sectionIndex + value + type + target + actionType  + userid +  password);
        data = { sectionIndex:sectionIndex, value:value, type:type, target:target, actionType:actionType, userid:userid , password:password,hash:hash};

        var boxIndex = $(".boxContentCount_" + sectionIndex).last().val();
        addBoxContent(data, url, boxIndex, sectionIndex, value, type, target, actionType);

    });    

    function addBoxContent(data, url, boxIndex,sectionIndex, value, type, target, actionType)
    {
        loader.showPleaseWait();        
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                loader.hidePleaseWait();   
                appendDataContainer(url, boxIndex, sectionIndex, value, type, target, actionType);
            },
            error: function(e) {
                loader.hidePleaseWait();   
                console.log("error");          
            }
        });
               
    } 

    function appendDataContainer(url, boxIndex, sectionIndex, value, type, target, actionType)
    {
        var obj = '{"url":"' + url + '","sectionIndex":"' +  sectionIndex +
            '","boxIndex":"' + boxIndex +
            '","value":"' +value +
            '","type":"' + type +
            '","target":"' + target +
            '","actionType":"' + actionType +'"}';
        var newBoxIndex = boxIndex + 1;
        var valueData = "value_"+sectionIndex+"_"+boxIndex;
        var typeData = "type_"+sectionIndex+"_"+boxIndex;
        var targetData = "target_"+sectionIndex+"_"+boxIndex;
        var actionTypeData = "actionType_" + sectionIndex + "_"+ boxIndex;

        var dataToAppend = '<tr id="tr_"'+sectionIndex+ '"><td><div class="btn-toolbar" role="toolbar"><button type="button" class="btn btn-danger edit_btn" id="'+"data_"+sectionIndex+"_"+boxIndex+'"'+
                                                                    'data="" data-toggle="modal" data-target="#myModal"><span class="glyphicon-center glyphicon glyphicon-cog"></span</button></div></td>'+
                                '<td id="'+valueData+'">'+value+'</td>' +
                                '<td id="'+typeData+'">'+type+'</td>' +
                                '<td id="'+targetData+'">'+target+'</td>' +
                                '<td id="'+actionTypeData+'">'+actionType+'<span style="display:none;"></span>'+
                                '<input type="hidden" class="boxContentCount_'+sectionIndex+'" value="'+newBoxIndex+'"/>'
                                +'</td>'+'</tr>'; 
        $("#tableme_"+sectionIndex+" tr").last().after(dataToAppend);
        $("#data_"+ sectionIndex + "_" + boxIndex).attr('data', obj);                                        
    }       

    function setBoxContent(data, url, boxIndex, sectionIndex, value, type, target, actionType) 
    {
        console.log(actionType);
        loader.showPleaseWait();        
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                loader.hidePleaseWait();   
                updateDataContainer(url, boxIndex, sectionIndex, value, type, target, actionType);
            },
            error: function(e) {
                loader.hidePleaseWait();   
                console.log("error");          
            }
        });
    }

    function updateDataContainer(url, boxIndex, sectionIndex, value, type, target, actionType)
    {
        $("#value_" + sectionIndex + "_" + boxIndex).html(value);
        $("#type_" + sectionIndex + "_" + boxIndex).html(type);
        $("#target_" + sectionIndex + "_" + boxIndex).html(target);
        $("#actionType_" + sectionIndex + "_" + boxIndex).html(actionType);
        console.log("#actionType_" + sectionIndex + "_" + boxIndex);
        var obj = '{"url":"' + url +
            '","sectionIndex":"' +  sectionIndex +
            '","boxIndex":"' + boxIndex +
            '","value":"' +value +
            '","type":"' + type +
            '","target":"' + target +
            '","actionType":"' + actionType +'"}';

        $("#data_"+ sectionIndex + "_" + boxIndex).attr('data', obj);
    }

})(jQuery);    