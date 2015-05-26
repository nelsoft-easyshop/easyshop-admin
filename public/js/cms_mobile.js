(function () {


    var userid;
    var actionTypeShowproductdetails;
    
    $(document).ready(function(){
        
        /**
         * Obtain important values and constants from the DOM
         */
        userid = $("#userid").val();
        actionTypeShowproductdetails = $('#action-type-showproductdetails').val();
    });




    /**
     * Toggle box contents section field disabled attribute
     *
     * @param DOM.mobile-home-section-form  $formContainer
     */
    function toggleSectionFields($formContainer)
    {
         var selectedActionType = $formContainer.find('.selectbox-action-type').val()
                                                .replace(/ /gi, '').toLowerCase();
        $targetContainer = $formContainer.find('.target');
        $slugContainer = $formContainer.find('.value');
        if(selectedActionType === actionTypeShowproductdetails){
            $targetContainer.attr('disabled', 'disabled');
            $slugContainer.removeAttr('disabled');
        }
        else{
            $targetContainer.removeAttr('disabled');
            $slugContainer.attr('disabled', 'disabled');
        }
    }

    $('#drop_actionType, #drop_actionTypeEdit').on('change', function(){
        var $actionSelectBox = $(this);
        var $formContainer = $actionSelectBox.closest('.mobile-home-section-form');
        toggleSectionFields($formContainer);
    });

    $('.bgcolor').each( function() {
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            change: function(hex, opacity) {
                if( !hex ) return;
                if( opacity ) hex += ', ' + opacity;
                if( typeof console === 'object' ) {
                }
            },
            theme: 'bootstrap'
        });

    });

    $(document.body).on('click','#setSectionHead',function () {
        var $this = $(this);
        var $form = $this.closest("form");
        var index = $form.find("#index").val();
        var name = $form.find("#categoryName option:selected").val();
        var bgcolor = $form.find('.bgcolor').val();
        var type = $form.find("#themeName option:selected").val();
        var url = $this.data('url');

        var requestData = {
            index:index, 
            name:name, 
            bgcolor:bgcolor, 
            type:type, 
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {

            requestData.hash = hash;
            requestData.callback = '?';
            
            if(name == "" || bgcolor == "" || type == "") {
                showErrorModal("Please fill up the required fields");    
            }
            else {
                loader.showPleaseWait(); 
                $("#sectionNav_"+index).html(name);
                setSectionHead(url,requestData);          
            }
           
        });
    });   

    $("#manageMainSlide").on('click','#submitAddMainSlide',function (e) { 
        e.preventDefault();
        var url = $(this).data('url');
        var value = $("#valueMainSlide").val();
        var myvalue = $("#photoFile").val();
        var mainSlideTarget = $("#mainSlideTarget").val();
        var actionTypes = $("#dropActionTypes option:selected").val();

        var requestData = {
            myvalue:myvalue, 
            value:value, 
            mainSlideTarget:mainSlideTarget, 
            actionTypes:actionTypes, 
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
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
    });

    $("#manageMainSlide").on('click','#movedown',function () {       

        var $this = $(this);
        var index = $this.data('index');
        var value = $this.data('value');
        var target = $this.data('target');
        var count = $this.data('count');
        var order = index;
        var nodename = "mainSlide";
        var url = $this.data('url');

        loader.showPleaseWait();

        if(order == (count - 1)) {
            order = order;
        } 
        else {
             order = order + 1;
        }
        
        var requestData = {
            index:index, 
            value:value, 
            target:target, 
            order:order, 
            nodename:nodename,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            requestData.hash = hash;
            requestData.callback= '?';
            setPositionMainSlide(requestData,order, url);
        });
    });   

    $("#myTabContent").on('click','#deleteMainSlide',function (e) { 
        e.preventDefault();
        var $this = $(this);
        var index = $this.data('index');
        var nodename = $this.data('nodename');
        var url = $this.data('url');
        nodename = nodename == "mainSlide" ? "mainSlide" : "productSlide";   
        index += 1;

        var requestData = {
            index:index, 
            nodename:nodename,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
                     
            requestData.hash = hash;
            requestData.callback= '?';
            
            loader.showPleaseWait();
            $.ajax({
                type: 'get',
                url: url,
                data:requestData,
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

    });   

    $("#manageMainSlide").on('click','#moveup',function () { 
        loader.showPleaseWait();
        
        var $this = $(this);
        var index = $this.data('index');
        var value = $this.data('value');
        var url = $this.data('url');
        var target = $this.data('target');
        var order = index;
        var nodename = "mainSlide";

        if(order > 0) {
            order = order - 1;
        } 
        else {
           order = 0;
        }
        
        var requestData = {
            index:index, 
            value:value, 
            target:target, 
            order:order, 
            nodename:nodename,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            requestData.hash = hash;
            requestData.callback= '?';
            setPositionMainSlide(requestData, order, url);
        });
    });     

    $("#manageMainSlide").on('click','#submit',function () {    
        var $this = $(this);
        var index = $this.data('index');
        var value = $this.closest("form").find("#photoFile").val();
        var target = $this.closest("form").find('#editMainSlideTarget').val();
        var actionType = $this.closest("form").find('#dropActionTypes option:selected').val();
        var count = $this.data('count');
        var url = $this.data('url');
        var order = index;
        var mainSlideForm = "#mainSlideForm" + index;
        var hashMainSlide = "#hashEditMainSlide" + index;
        
        var requestData = {
            index:index, 
            value:value, 
            target:target, 
            actionType:actionType, 
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            
            $this.closest("form").find("#hashEditMainSlide").val(hash);
            requestData.hash = hash;
            requestData.callback = '?';
            var ext = value.split('.').pop().toLowerCase();
            if( value !== "" && ($.inArray(ext, ['gif','png','jpg','jpeg']) === -1) ) {
                showErrorModal("Please upload an image");
            }
            else {
                $(mainSlideForm).modal("hide");
                setDataMainSlide(url, requestData, order, mainSlideForm);
            }
        });

    }); 

    function setSectionHead(url,data) 
    {
        $.ajax({
            type: 'get',
            url: url,
            data:data,
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

    function setPositionMainSlide(data,order,url) 
    {
        $.ajax({
            type: 'get',
            url: url,
            data:data,
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


    function setDataMainSlide(url, data,order, mainSlideForm) 
    {
        loader.showPleaseWait();
        $(mainSlideForm).ajaxForm({
            url: url,
            type: 'get', 
            dataType: 'jsonp',
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            beforeSubmit: function(e) {
                event.preventDefault();
            },
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

    function addMainSlide(url) 
    {
        loader.hidePleaseWait();
        $('#mainSlideForm').ajaxForm({
            url: url,
            type: 'get', 
            dataType: 'jsonp',
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

    $(document.body).on('click','.edit_btn',function (e) { 
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
        var $formContainer =  $("#myModal").find('.mobile-home-section-form');
        toggleSectionFields($formContainer);       
    });  

    $('.category-section-trigger').on('click', function(){        
        setTimeout(function(){
            var $formContainer =  $("#myTabContent").find('.add-section.mobile-home-section-form');
            toggleSectionFields($formContainer);
        }, 500);
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

        var requestData = {
            order:order, 
            sectionIndex:sectionIndex, 
            value:value, 
            type:type, 
            boxIndex:boxIndex,
            target:target,
            actionType:actionType,
            userid: userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            requestData.hash = hash;
            setBoxContent(requestData, url, boxIndex, sectionIndex, value, type, target, actionType, tableIndex);            
        });

    });

    $(document.body).on('click','#addBoxContent',function (e) {         
        var $this = $(this);
        var $form = $this.closest("form");
        var tableIndex = $form.find("#index").val();
        var value = $form.find("#value").val();
        var type = $form.find("#type").val();
        var target = $form.find("#target").val();
        var url = $this.data('url');
        var sectionIndex = $form.find("#index").val();
        var actionType = $form.find("#drop_actionType option:selected").text();
        
        var requestData = {
            sectionIndex:sectionIndex, 
            value:value, 
            type:type, 
            target:target,
            actionType:actionType,
            userid: userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            requestData.hash = hash;
            var boxIndex = $(".boxContentCount_" + sectionIndex).last().val();

            if(value == "" || type == "") {
                showErrorModal("Please fill up the required fields");
            }
            else {
                loader.showPleaseWait();
                addBoxContent(requestData, url, boxIndex, sectionIndex, value, type, target, actionType, tableIndex);
            }
        });
    });    

    $(document.body).on('click','.removeButton',function (e) { 

        var $this = $(this);
        var index = $this.data("index").toString();
        var subIndex = $this.data("subindex").toString();
        var nodename = $this.data("nodename").toString();
        var url = $this.data("url");
        
        var requestData = {
            index:index, 
            subIndex:subIndex, 
            nodename:nodename, 
            userid: userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            requestData.hash = hash;            
            loader.showPleaseWait();
            $.ajax({
                type: 'get',
                url: url,
                data:requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
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
    });    

    function addBoxContent(data, url, boxIndex,sectionIndex, value, type, target, actionType, tableIndex)
    {
  
        $.ajax({
            type: 'get',
            url: url,
            data:data,
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
            type: 'get',
            url: url,
            data:data,
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

    function showErrorModal(messages)
    {
            loader.hidePleaseWait();
            $("#errorTexts").html(messages); 
            $("#customerror").modal('show');  
    }    

})(jQuery);    
