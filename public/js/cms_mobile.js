(function () {

    var userid = $("#userid").val();
    var password = $("#password").val();

    $(document.body).on('click','#setSectionHead',function () {    
        var index = $(this).closest("form").find("#index").val();
        var name = $(this).closest("form").find("#name").val();
        var bgcolor = $(this).closest("form").find('#bgcolor').val();
        var type = $(this).closest("form").find('#type').val();
        var userid = $("#userid").val();
        var password = $("#password").val();
        var url = $(this).data('url');
        var hash =  hex_sha1(index + name + bgcolor + type  + userid + password);
        data = { index: index, name:name, bgcolor:bgcolor, type:type, userid:userid,  password:password, hash:hash, callback:'?'};
        
        if(name == "" || bgcolor == "" || type == "") {
             showErrorModal("Please fill up the required fields");    
        }
        else {
            loader.showPleaseWait();   
            setSectionHead(url,data);          
        }

    });   

    $("#manageMainSlide").on('click','#submitAddMainSlide',function (e) { 
        e.preventDefault();
        var url = $(this).data('url');
        var value = $("#valueMainSlide").val();
        var myvalue = $("#photoFile").val();
        var mainSlideCoordinate = $("#mainSlideCoordinate").val();
        var mainSlideTarget = $("#mainSlideTarget").val();
        var useridMainSlide = userid;
        var passwordMainSlide = password;
        var hash = hex_sha1(myvalue + value + mainSlideCoordinate + mainSlideTarget + useridMainSlide + passwordMainSlide);
        $("#hashMainSlide").val(hash);

        var ext = myvalue.split('.').pop().toLowerCase();

        if( ($.inArray(ext, ['gif','png','jpg','jpeg']) === -1) 
            || myvalue == "" 
            || myvalue == "undefined" 
            || value == ""){
            showErrorModal("Please upload an image");         
        }

        else {
            loader.showPleaseWait();    
            addMainSlide(url);
        }

    });

    $("#manageMainSlide").on('click','#movedown',function () {       

        var index = $(this).data('index');
        var userid = $("#userid").val();
        var password = $("#password").val();
        var value = $(this).data('value');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var count = $(this).data('count');
        var order = index;
        var nodename = "mainSlide";
        var url = $(this).data('url');

        loader.showPleaseWait();

        if(order == (count - 1)) {
            order = order;
        } else {
             order = order + 1;
        }
        var hash = hex_sha1(index + value + coordinate + target + order + nodename + userid + password);
        data = { index: index, value: value, coordinate:coordinate, target:target, order:order, nodename:nodename,  userid: userid, hash:hash, callback:'?'};
        setPositionMainSlide(data,order, url);
    });   

    $("#myTabContent").on('click','#deleteMainSlide',function (e) { 
        e.preventDefault();
        var index = $(this).data('index');
        var nodename = $(this).data('nodename');
        var userid = $("#userid").val();
        var password = $("#password").val();
        var url = $(this).data('url');
        nodename = nodename == "mainSlide" ? "mainSlide" : "productSlide";   
        index += 1;
        var hash = hex_sha1(index +nodename + userid + password);
        data = { index: index, nodename:nodename, userid: userid, hash:hash, callback:'?'};         
        loader.showPleaseWait();
            $.ajax({
                type: 'post',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    loader.hidePleaseWait();
                    $("#manageMainSlide").load('mobileSlides');                
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    $("#manageMainSlide").load('mobileSlides');  
          
                }
            });

    });   

    $("#manageMainSlide").on('click','#moveup',function () { 
        loader.showPleaseWait();

        var index = $(this).data('index');
        var userid = $("#userid").val();
        var value = $(this).data('value');
        var url = $(this).data('url');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var password = $("#password").val();
        var order = index;
        var nodename = "mainSlide";

        if(order > 0) {
            order = order - 1;
        } else {
           order = 0;
        }
            
        var hash = hex_sha1(index + value + coordinate + target + order + nodename + userid + password);
        data = { index: index, value: value,  coordinate:coordinate, target:target, order:order, nodename:nodename, userid: userid, hash:hash, callback:'?'};
        setPositionMainSlide(data,order, url);
    });     

    $("#manageMainSlide").on('click','#submit',function () {    
        var index = $(this).data('index');
        var userid = $("#userid").val();
        var value = $(this).closest("form").find("#photoFile").val();
        var password = $("#password").val();
        var coordinate = $(this).closest("form").find("#editMainSlideCoordinate").val();
        var target = $(this).closest("form").find('#editMainSlideTarget').val();
        var count = $(this).data('count');
        var url = $(this).data('url');
        var order = index;
        var mainSlideForm = "#mainSlideForm" + index;
        var hashMainSlide = "#hashEditMainSlide" + index;
        var hash =  hex_sha1(index + value + coordinate + target  + userid + password);
        $(this).closest("form").find("#hashEditMainSlide").val(hash);
        data = { index: index, value: value, coordinate:coordinate,  target:target,  password:password, hash:hash, callback:'?'};


        var ext = value.split('.').pop().toLowerCase();

        if(coordinate == "") {
            showErrorModal("Please supply a coordinate");
        }
        else if( ($.inArray(ext, ['gif','png','jpg','jpeg']) === -1) ) {
            shwoErrorModal("Please upload an image");
        }
        else {
            setDataMainSlide(url, data,order,mainSlideForm);
        }
    }); 

    function setSectionHead(url,data) {
        $.ajax({
            type: 'post',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                loader.hidePleaseWait();
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });
    }      

    function setPositionMainSlide(data,order,url) {
        $.ajax({
            type: 'post',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                loader.hidePleaseWait();
                $("#manageMainSlide").load('mobileSlides');  
            },
            error: function(e) {
                loader.hidePleaseWait();
                $("#manageMainSlide").load('mobileSlides');  
            }
        });
    }


    function setDataMainSlide(url, data,order, mainSlideForm) {
        loader.showPleaseWait();
        $(mainSlideForm).ajaxForm({
            url: url,
            type: 'post', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                loader.hidePleaseWait();
                $("#manageMainSlide").load('mobileSlides');                
            },
            error: function(e) {
                loader.hidePleaseWait();
                $("#manageMainSlide").load('mobileSlides');
            }
        }); 
        $(mainSlideForm).submit();
    }

    function addMainSlide(url) {
        loader.hidePleaseWait();
        $('#mainSlideForm').ajaxForm({
            url: url,
            type: 'post', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                loader.hidePleaseWait();
                $("#manageMainSlide").load('mobileSlides');
            },
            error: function(e) {
                loader.hidePleaseWait();
                $("#manageMainSlide").load('mobileSlides');
            }
        }); 
        $('#mainSlideForm').submit();

    } 

    $(document.body).on('click','.btn-danger',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#edit_value").val(data.value);
        $("#edittable_index").val(data.tableindex);
        $("#edit_type").val(data.type);
        $("#edit_target").val(data.target);
        $("#edit_url").val(data.url);
        $("#edit_boxindex").val(data.boxIndex);
        $("#edit_sectionIndex").val(data.sectionIndex);
        $('#drop_actionTypeEdit option[value="'+data.actionType+'"]').attr("selected", "selected");
    });  

    $("#myModal").on('click','#mdl_save',function (e) { 
        var tableIndex = $("#edittable_index").val();
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
        setBoxContent(data, url, boxIndex, sectionIndex, value, type, target, actionType, tableIndex);
    });

    $(document.body).on('click','#addBoxContent',function (e) { 
        var tableIndex = $(this).closest("form").find("#index").val();
        var value = $(this).closest("form").find("#value").val();
        var type = $(this).closest("form").find("#type").val();
        var target = $(this).closest("form").find("#target").val();
        var url = $(this).data('url');
        var sectionIndex = $(this).closest("form").find("#index").val();
        var actionType = $(this).closest("form").find("#drop_actionType option:selected").text();
        var hash = hex_sha1(sectionIndex + value + type + target + actionType  + userid +  password);
        data = { sectionIndex:sectionIndex, value:value, type:type, target:target, actionType:actionType, userid:userid , password:password,hash:hash};

        var boxIndex = $(".boxContentCount_" + sectionIndex).last().val();

        if(value == "" || type == "") {
            showErrorModal("Please fill up the required fields");
        }
        else {
            loader.showPleaseWait();
            addBoxContent(data, url, boxIndex, sectionIndex, value, type, target, actionType, tableIndex);
        }

    });    

    $(document.body).on('click','.removeButton',function (e) { 

        var index = $(this).data("index").toString();
        var subIndex = $(this).data("subindex").toString();
        var nodename = $(this).data("nodename").toString();
        var url = $(this).data("url");

        var hash = hex_sha1(index + subIndex + nodename + userid +  password);
        data = { index:index, subIndex:subIndex, nodename:nodename, userid:userid, userid:userid, hash:hash};
        loader.showPleaseWait();
        $.ajax({
            type: 'post',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
        console.log("here");                
                loader.hidePleaseWait();   
                var reloadUrl = "/cms/mobile/getBoxContent/"+index;
                var tableSelector = "#tableIndex_"+index;
                $(tableSelector).load(reloadUrl);        
            },
            error: function(e) {
                loader.hidePleaseWait();   
            }
        });

    });    

    function addBoxContent(data, url, boxIndex,sectionIndex, value, type, target, actionType, tableIndex)
    {
  
        $.ajax({
            type: 'post',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                if(json.sites[0]["success"] != "success") {
                    loader.hidePleaseWait();    
                    showErrorModal("Slug Does Not Exist");
                }
                else {
                    loader.hidePleaseWait();   
                    var reloadUrl = "/cms/mobile/getBoxContent/"+tableIndex;
                    var tableSelector = "#tableIndex_"+tableIndex;
                    $(tableSelector).load(reloadUrl);        
                }
            },
            error: function(e) {
                loader.hidePleaseWait();   
            }
        });
               
    } 

    function setBoxContent(data, url, boxIndex, sectionIndex, value, type, target, actionType, tableIndex) 
    {
        loader.showPleaseWait();
        $.ajax({
            type: 'post',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                if(json.sites[0]["success"] != "success") {
                    loader.hidePleaseWait();    
                    showErrorModal("Slug Does Not Exist");
                }
                else {
                    loader.hidePleaseWait();  
                    var reloadUrl = "/cms/mobile/getBoxContent/"+tableIndex;
                    var tableSelector = "#tableIndex_"+tableIndex;
                    $(tableSelector).load(reloadUrl);                      
                }


            },
            error: function(e) {
                loader.hidePleaseWait();   
            }
        });
    }

    function showErrorModal(messages) {
            loader.hidePleaseWait();
            $("#errorTexts").html(messages); 
            $("#customerror").modal('show');  
    }    

})(jQuery);    