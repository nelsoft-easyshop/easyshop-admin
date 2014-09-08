(function () {
    var globalUserId = $('#userIdSpan').html();
    var globalPassword = $('#adminPasswordSpan').html();
   $("form").submit(function(e){
        if($(this).attr("id") != "mainSlideForm" && $(this).attr("id") != "left" && $(this).attr("id") != "right" && $(this).attr("id") != "mid" && $(this).attr("class") != "form-horizontal submit-test") {
                    return false;
        }
    
    })

    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });


    $("#productSlide").on('click','#submitAddProduct',function (e) { 
          
        var value = $(this).closest("form").find("#valueProductSlide").val();
        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');
        if(value == "") {
            $("#error").modal('show');
        }        
        else {
            var hash = hex_sha1(value + userid + password);
            data = {value:value, userid:userid , hash:hash};
            addDataProductSlide(data, url);            
        }
    });   

    $('#AddSectionProduct').on('click','#submitSectionProduct',function (e) { 
        e.preventDefault();
        var form = "#formSectionProduct";
        var typeSectionProduct = $("#typeSectionProduct").val();
        var indexSectionProduct = $("#indexSectionProduct").val();
        var valueSectionProduct =  $(this).closest("form").find("#photoFile").val();
        var productIndexSectionProduct = $("#productIndexSectionProduct").val();
        var userIdSectionProduct = globalUserId;
        var passwordSectionProduct = globalPassword;
        var url = $(this).data('url');
        var hash = hex_sha1(typeSectionProduct + indexSectionProduct + valueSectionProduct + productIndexSectionProduct + userIdSectionProduct + passwordSectionProduct);
        $(this).closest("form").find("#hashAddSectionProduct").val(hash);        

        if(indexSectionProduct < 0 || indexSectionProduct == "" || valueSectionProduct == "" || productIndexSectionProduct < 0 || productIndexSectionProduct == "" || indexSectionMainPanel == "Product") {
            $("#error").modal('show'); 
        }
        else {
            data = {type:typeSectionProduct, index:indexSectionProduct, myfile:valueSectionProduct, productindex:productIndexSectionProduct, userid:userIdSectionProduct, password:passwordSectionProduct ,hash:hash};
            if(typeSectionProduct.toLowerCase() == "image") {

                AddSectionProductImage(data,url,form);            
            } 
            else {
                AddSectionProduct(data,url);            
            }
        }

    });   
    function AddSectionProduct(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');

                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {
                        console.log(json.sites[0]["slugerror"]);                        
                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){
                        console.log(json.sites[0]["bounds"]);                       
                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }
                        $("#loading").modal('hide');
                        $("#customerror").modal('show');     
                }
                else {
                    $("#success").modal('show');                   
                }
             
            },
            error: function(e) {
                $("#errorTexts").html("You are not authorized for this action");
                $("#loading").modal('hide');
                $("#customerror").modal('show');
  
            }
        });
    }

    function AddSectionProductImage(data,url,form) {
        $("#loading").modal('show');
        $(form).ajaxForm({
            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {

                $("#loading").modal('hide');
                $("#success").modal('show');                   
               
            },
            error: function(e) {
                $("#loading").modal('hide');
                $("#success").modal('show');                   

            }
        }); 
        $(form).submit();
    }

    $('#addSectionMainPanel').on('click','#submitSectionMainPanel',function (e) { 
        e.preventDefault();
        var form = "#formSectionMainPanel";
        var typeSectionMainPanel = $("#typeSectionMainPanel").val();
        var valueSectionMainPanel = $(this).closest("form").find("#photoFile").val();
        var productindexSectionMainPanel = $("#productindexSectionMainPanel").val();
        var coordinateSectionMainPanel = $("#coordinateSectionMainPanel").val();
        var targetSectionMainPanel = $("#targetSectionMainPanel").val();
        var indexSectionMainPanel = $("#indexSectionMainPanel").val();
        var userIdSectionMainPanel = globalUserId;
        var passwordSectionMainPanel = globalPassword;
        var url = $(this).data('url');
        var hash = hex_sha1(indexSectionMainPanel + typeSectionMainPanel + valueSectionMainPanel + productindexSectionMainPanel + coordinateSectionMainPanel + targetSectionMainPanel + userIdSectionMainPanel + passwordSectionMainPanel);
        $(this).closest("form").find("#hashAddSectionMainPanel").val(hash);        

        if(typeSectionMainPanel == "image" || typeSectionMainPanel == "Image"){
            if(valueSectionMainPanel == "" || coordinate == "" || target == "" || indexSectionMainPanel =="none" || indexSectionMainPanel =="product" || indexSectionMainPanel =="Product" || productindexSectionMainPanel < 0 || productindexSectionMainPanel == "") {
                $("#error").modal('show');                
            }
            else {
                alert();                
                data = {type:typeSectionMainPanel, index:indexSectionMainPanel, value:valueSectionMainPanel, productindex:productindexSectionMainPanel, coordinate:coordinateSectionMainPanel, target:targetSectionMainPanel, userid:userIdSectionMainPanel, hash:hash};
                addSectionMainPanel(data,url,form, typeSectionMainPanel);       
            }
        }
        else {
            if(value == "" || productindexSectionMainPanel < 0  || indexSectionMainPanel =="none" || indexSectionMainPanel =="product" || indexSectionMainPanel =="Product" || productindexSectionMainPanel == "") {
                $("#error").modal('show');                
            } 
            else {
                data = { index:indexSectionMainPanel, type:typeSectionMainPanel, myfile:valueSectionMainPanel, productindex:productindexSectionMainPanel, coordinate:coordinateSectionMainPanel, target:targetSectionMainPanel, userid:userIdSectionMainPanel,password:passwordSectionMainPanel, hash:hash};
                addSectionMainPanelProduct(data,url,form, typeSectionMainPanel);                 
            }
        }
    });
    function addSectionMainPanelProduct(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');

                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                }
                else {
                    $("#success").modal('show');                   
                }
             
            },
            error: function(e) {
                $("#errorTexts").html("Product index out of bounds");
                $("#loading").modal('hide');
                $("#customerror").modal('show');
  
            }
        });
    }

    function addSectionMainPanel(data,url,form, typeSectionMainPanel) {
        $("#loading").modal('show');
        $(form).ajaxForm({
            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {

                $("#loading").modal('hide');
                $("#success").modal('show');                   
               
            },
            error: function(e) {
                $("#loading").modal('hide');
                $("#success").modal('show');                   

            }
        }); 
        $(form).submit();
    }

 


    $("#mainSlide").on('click','#movedown',function () {       

        var index = $(this).data('index');
        var userid = globalUserId;
        var password = globalPassword;
        var value = $(this).data('value');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var count = $(this).data('count');
        var order = index;
        var nodename = "mainSlide";
        var url = $(this).data('url');


        if(order == (count - 1)) {
            order = order;
        } else {
             order = order + 1;
        }
        var hash = hex_sha1(index + value + coordinate + target + order + nodename + userid + password);
        data = { index: index, value: value, coordinate:coordinate, target:target, order:order, nodename:nodename,  userid: userid, hash:hash, callback:'?'};
        setPositionMainSlide(data,order, url);
    });

    $("#mainSlide").on('click','#moveup',function () { 

        var index = $(this).data('index');
        var userid = globalUserId;
        var value = $(this).data('value');
        var url = $(this).data('url');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var password = globalPassword;
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

    $("#addFeaturedProduct").on('click','#moveDownFeaturedProduct',function () { 
        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var password = globalPassword;
        var nodeName = "feedFeaturedProduct";
        var value = $(this).data('value');
        var count = $(this).data('count');
        if(order == (count - 1)) {
            order = order;
        } else {
             order = order + 1;
        }
        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};

        setFeedFeaturedProduct(data,order,url);        
    });


    $("#addPopularItemsDiv").on('click','#moveDownPopularItems',function () { 
        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var password = globalPassword;
        var nodeName = "feedFeaturedProduct";
        var value = $(this).data('value');
        var count = $(this).data('count');
        if(order == (count - 1)) {
            order = order;
        } else {
             order = order + 1;
        }
        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value,  hash:hash, callback:'?'};
        setFeedPopularItems(data,order,url);        
    });

    $("#addfeedPromoItems").on('click','#moveDownPromoItems',function () { 
        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var password = globalPassword;
        var nodeName = "feedPromoItems";
        var value = $(this).data('value');
        var count = $(this).data('count');
        if(order == (count - 1)) {
            order = order;
        } else {
             order = order + 1;
        }
        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};
        setFeedPromoItems(data,order,url);        
    });

    $("#addfeedPromoItems").on('click','#moveUpPromoItems',function () { 
        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var password = globalPassword;
        var nodeName = "feedPromoItems";
        var value = $(this).data('value');
        var count = $(this).data('count');
        if(order > 0) {
            order = order - 1;
        } else {
           order = 0;
        }
        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};
        setFeedPromoItems(data,order,url);        
    });

    $("#addfeedPromoItems").on('click','#submitPromoItemBtn',function () {     
        var index = $(this).data('index');
        var order = $(this).data('order');
        var url = $(this).data('url');
        var nodeName = "feedPromoItems";
        var count = $(this).data('count');
        var value = $(this).closest("form").find("#promoItem").val();
        var password = globalPassword;
        var userid = globalUserId;
        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};
        setFeedPromoItems(data,order,url);   
    });

    $("#addPopularItemsDiv").on('click','#moveUpPopularItems',function () { 
        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var password = globalPassword;
        var nodeName = "feedFeaturedProduct";
        var value = $(this).data('value');
        var count = $(this).data('count');
        if(order > 0) {
            order = order - 1;
        } else {
           order = 0;
        }
        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};
        setFeedPopularItems(data,order,url);        
    });

    $("#addPopularItemsDiv").on('click','#submitPopularItemBtn',function () {     
        var index = $(this).data('index');
        var order = $(this).data('order');
        var url = $(this).data('url');
        var nodeName = "feedPopularItems";
        var count = $(this).data('count');
        var value = $(this).closest("form").find("#popularItem").val();
        var password = globalPassword;
        var userid = globalUserId;

        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};
        setFeedPopularItems(data,order,url);   
    });



    $("#addFeaturedProduct").on('click','#moveUpFeaturedProduct',function () { 
        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var password = globalPassword;
        var nodeName = "feedFeaturedProduct";
        var value = $(this).data('value');
        var count = $(this).data('count');
        if(order > 0) {
            order = order - 1;
        } else {
           order = 0;
        }

        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};
        setFeedFeaturedProduct(data,order,url);        
    });

    $("#addFeaturedProduct").on('click','#submitFeaturedProductBtn',function () {     

        var index = $(this).data('index');
        var order = $(this).data('order');
        var url = $(this).data('url');
        var nodeName = "feedFeaturedProduct";
        var count = $(this).data('count');
        var value = $(this).closest("form").find("#featuredProduct").val();
        var password = globalPassword;
        var userid = globalUserId;

        var hash =  hex_sha1(index + nodeName + userid + order + value  + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, slug: value, hash:hash, callback:'?'};
        setFeedFeaturedProduct(data,order,url);   
    });

    $("#manageSelectDiv").on('click','#submitSelect',function () {     
        
        var checkuser = $(this).data('checkuser');
        var url = $(this).data('url');
        var value = $(this).closest("form").find("#value").val();
        var id = $(this).closest("form").find("#id").val();
        var password = globalPassword;
        var userid = globalUserId;
        var hash =  hex_sha1(value + userid + id + password);

        if(value == "") {
            $("#error").modal('show');
        }
        else {
            data = { value:value, userid: userid, id:id, hash:hash, checkuser:checkuser, callback:'?'};
            $(this).closest("form").find("#value").val(value);
            setSelectNode(data,url);             
        }

  
    });

    $("#mainSlide").on('click','#submitAddMainSlide',function (e) { 
        e.preventDefault();
        var url = $(this).data('url');
        var value = $("#valueMainSlide").val();
        var myvalue = $("#photoFile").val();
        var mainSlideCoordinate = $("#mainSlideCoordinate").val();
        var mainSlideTarget = $("#mainSlideTarget").val();
        var useridMainSlide = globalUserId;
        var passwordMainSlide = globalPassword;
        var hash = hex_sha1(myvalue + value + mainSlideCoordinate + mainSlideTarget + useridMainSlide + passwordMainSlide);
        $("#hashMainSlide").val(hash);

        if( myvalue == "" || myvalue == "undefined" || value == "" || mainSlideCoordinate == "" || mainSlideTarget == "")
        {
            $("#error").modal('show');         
        }
        else
        {
            addMainSlide(url);
        }
    });      

    $("#manageFeedBannerDiv").on('click','#submitFeedBanner',function () {     
        var string = "";

        var url = $(this).data('url');
        var img = $(this).closest("form").find("#photoFile").val();
        var target = $(this).closest("form").find("#target").val();
        var choice = $(this).closest("form").find("#choice").val();
        var password = globalPassword;
        var userid = globalUserId;
        var hash = hex_sha1(img  + choice + userid  + target + password);
        data = { img: img, choice:choice, userid: userid, hash:hash, target:target,   callback:'?'};
        var accessor = "#hash" + choice;
        $(accessor).val(hash);        
        if(target == "") {
            $("#error").modal('show');
        }
        else {
            var form = "#"+choice;
            $("#loading").modal('show');
            $(form).ajaxForm({
                url: url,
                type: 'GET', 
                dataType: 'jsonp',
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                        $("#loading").modal('hide');
                },
                error: function(e) {
                        $("#loading").modal('success');
                        $("#loading").modal('hide');
                }
            }); 
        }  

        $(form).submit();
    });



    $("#productSlide").on('click','#moveUpProductSlide',function () { 

        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var password = globalPassword;
        var nodeName = "productSlide";
        var value = $(this).data('value');
        var type = $(this).data('type');   
        var url = $(this).data('url');   
        
        if(order > 0) {
            order = order - 1;

        } else {
            order = 0;
        }

        var hash =  hex_sha1(index + nodeName + userid + order + value + type + password);
        data = { index: index, nodename:nodeName, userid: userid, hash:hash, order:order, value: value, type:type, callback:'?'};
        setPositionProductSlide(data, order, url);
    });

    $("#productSlide").on('click','#moveDownProductSlide',function () { 

        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var password = globalPassword;
        var nodeName = "productSlide";
        var value = $(this).data('value');
        var type = $(this).data('type');
        var count = $(this).data('count');

        if(order == (count - 1)) {
            order = order;
        } else {
             order = order + 1;
        }

        var hash =  hex_sha1(index + nodeName + userid + order + value + type + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, value: value, type:type, hash:hash, callback:'?'};
        setPositionProductSlide(data,order,url);
        
    });

    $("#myTabContent").on('click','#btnSetSectionMainPanel',function () { 
        var index = $(this).closest("form").find("#index").val();   
        var userid = globalUserId;
        var productindex = $(this).closest("form").find("#productindex").val();
        var form = "#formSetSectionMainPanel" + index +productindex;
        var hashSetSectionMainPanel = "#hashSetSectionMainPanel" + index +productindex;
        var password = globalPassword;
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var coordinate = $(this).closest("form").find("#coordinate").val();
        var target = $(this).closest("form").find("#target").val();
        var nodeName = "product_panel_main";
        var hash = hex_sha1(index + type  +  productindex + value +  coordinate + target  + userid + password);
        $(hashSetSectionMainPanel).val(hash);             
        if(type == "image" || type == "Image"){
            if(coordinate == "" || target == "") {
                $("#error").modal('show');                
            }
            else {
                data = {index:index , type:type, productindex:productindex, myfile:value, coordinate:coordinate, target:target,  userid:userid, hash:hash, callback:'?'};
                setSectionMainPanelImage(data, url , form);               
            }
        }
        else {
            if(value == "") {
                $("#error").modal('show');                
            }
            else {
                data = {index:index , type:type, productindex:productindex, myfile:value, coordinate:coordinate, target:target,  userid:userid, hash:hash, callback:'?'};
                setSectionMainPanel(data, url , form);               
            }
        }

    });

    function setSectionMainPanelImage(data, url , form) {
     $("#loading").modal('show');
        $(form).ajaxForm({
            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {

                $("#loading").modal('hide');
                $("#success").modal('show');                   
               
            },
            error: function(e) {
                $("#loading").modal('hide');
                $("#success").modal('show');                   

            }
        }); 
        $(form).submit();
    }

    function setSectionMainPanel(data, url , form) {

        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');

                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                }
                else {
                    $("#success").modal('show');                   
                }
            },
            error: function(e) {
                    $("#loading").modal('hide');
                    $("#error").modal('show');
            }
        });
    }


    $("#myTabContent").on('click','#btnSetSectionPanel',function () { 

        var index = $(this).closest("form").find("#index").val();   
        var userid = globalUserId;
        var productindex =$(this).closest("form").find("#productindex").val();
        var password = globalPassword;
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var hashSetProductPanel = "#hashSetProductPanel" + index +productindex;
        var form = "#formSetSectionProduct" + index +productindex;        
        var hash = hex_sha1(index + type + productindex + value + userid + password);
        $(hashSetProductPanel).val(hash);    
        if(value == "") {
            $("#error").modal('show');                
        }
        else {
            if(type.toLowerCase() == "image") {
                data = {index:index, type:type, productindex:productindex,  value:value, userid:userid, hash:hash, callback:'?'};                      
                setSectionPanelImage(data, url, form);            
            }
            else {
                data = {index:index, type:type, productindex:productindex,  myfile:value, userid:userid, hash:hash, callback:'?'};                                      
                setSectionProduct(data, url, form);                            
            }
        }

    });

    function setSectionProduct(data, url, form) {


        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');

                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                }
                else {
                    $("#success").modal('show');                   
                }
            },
            error: function(e) {
                $("#errorTexts").html("Please try again");
                $("#loading").modal('hide');
                $("#customerror").modal('show');
            }
        });
    }  

    function setSectionPanelImage(data, url, form) {

     $("#loading").modal('show');
        $(form).ajaxForm({
            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {

                $("#loading").modal('hide');
                $("#success").modal('show');                   
               
            },
            error: function(e) {
                $("#loading").modal('hide');
                $("#success").modal('show');                   

            }
        }); 
        $(form).submit();

/*        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');

                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                }
                else {
                    $("#success").modal('show');                   
                }
            },
            error: function(e) {
                $("#errorTexts").html("Please try again");
                $("#loading").modal('hide');
                $("#customerror").modal('show');
            }
        });*/
    }  

    $("#addfeedPromoItems").on('click','#addPromoItemBtn',function () { 

        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');
        var slug = $(this).closest("form").find("#promoItem").val();
        var hash = hex_sha1(slug + userid + password); 
        if(slug == "") {
            $("#error").modal('show');
        }
        else {
            data = {slug:slug, userid:userid, hash:hash,  callback:'?'};
            addfeedPromoItems(data, url);            
        }            

    });

    $("#addPopularItemsDiv").on('click','#addPopularItemBtn',function () { 

        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');
        var slug = $(this).closest("form").find("#popularItem").val();
        var hash = hex_sha1(slug + userid + password); 
        if(slug == "") {
            $("#error").modal('show');
        }
        else {
            data = {slug:slug, userid:userid, hash:hash,  callback:'?'};
            addPopularItem(data, url);            
        }        

    });

    $("#addFeaturedProduct").on('click','#addFeaturedProductBtn',function () { 

        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');
        var slug = $(this).closest("form").find("#featuredProduct").val();
        var hash = hex_sha1(slug + userid + password); 
        if(slug == "") {
            $("#error").modal('show');
        }
        else {
            data = {slug:slug, userid:userid, hash:hash,  callback:'?'};
            addFeaturedProduct(data, url);            
        }

    });

    $("#nodeTypes").on('click','#btnAddType',function () { 

        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var hash = hex_sha1(type + userid + password); 

        if(type == "") {
                $("#error").modal('show');               
        }       
        else {
            data = {value:type, userid:userid, hash:hash,  callback:'?'};
            addType(data, url);        
        } 

    });


    $("#productSideBanner").on('click','#submitProductSidebanner', function() {
        $("#loading").modal('show');
        var sidebanner = $("#sidebanner").val();
        var url = $(this).data('url');
        var userid = globalUserId;
        var password = globalPassword;
        var hash = hex_sha1(sidebanner + userid + password);
        data = { value:sidebanner, userid:userid, hash: hash, callback: '?'};
        if(value == "") {
            $("#error").modal('show');
            $("#loading").modal('hide');
        }
        else {
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                        $("#loading").modal('hide');
                        $("#success").modal('show');
                },
                error: function(e) {
                        $("#loading").modal('hide');
                        $("#error").modal('show');
                }
            });          
        }

    });


    $("#productSlideTitle").on('click','#submitProductSlideTitle', function() {

        $("#loading").modal('show');
        var slidetitle = $("#slidetitle").val();
        var password = globalPassword;
        var userid = globalUserId;
        var url = $(this).data('url');
        var hash = hex_sha1(slidetitle + userid + password);    
        data = { productslidetitle:slidetitle, userid:userid, hash:hash, callback: '?'};
        if(slidetitle == "") {
            $("#error").modal('show');
            $("#loading").modal('hide');
        }
        else {
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                        $("#loading").modal('hide');
                        $("#success").modal('show');
                },
                error: function(e) {
                        $("#loading").modal('hide');
                        $("#error").modal('show');
      

                }
            });            
        }


    });

    $("#setText").on('click','#submitBannerText', function() {
        $("#loading").modal('show');
        var url = $(this).data('url');
        var bannertext = $("#bannertext").val();
        var userid = globalUserId;
        var password = globalPassword;
        var string = bannertext + userid + password;
        var hashed = hex_sha1(string);
        data = { value:bannertext , userid:userid, hash:hashed, callback: '?'};

        if(bannertext == "") {
            $("#error").modal('show');
            $("#loading").modal('hide');              
        }
        else {
             $.ajax({
                type: 'GET',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    $("#success").modal('show');  
                    $("#loading").modal('hide');  
                },
                error: function(e) {
                    $("#error").modal('show'); 
                    $("#loading").modal('hide');  
                }
            });            
        }       


    });



    $("#myTabContent").on('click','#btnSectionHead',function () {   
        var index = $(this).data('index');
        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var css_class = $(this).closest("form").find("#cssclass").val();
        var layout = $(this).closest("form").find("#layout").val();
        var title = $(this).closest("form").find("#title").val();
        var hash = hex_sha1(index + type + value + css_class + layout + title + userid + password);
        if(type == "" || value == "" || css_class == "" || layout == "") {
            $("#error").modal('show');   
        }
        else {
            data = { index:index , type:type, value:value,  css_class:css_class, layout:layout, title:title, userid:userid, hash:hash, callback:'?'};
            setDataSectionHead(data, url);            
        }

    });


    $("#AddSectionProduct .dropdown-menu span").click(function(){

        var text = $(this).text().toLowerCase();

        var index = $(this).data('index');
        var node = $(this).data('node');
        var sectionindex = $(this).data('sectionindex');
        var selector = "#mybutton" + index;
        var selector_for_button = "#btntext" + index;
        $(selector).text(text);
        $(selector_for_button).text(text);
        var imagetype = "imagetype";
        var divselector = "#imagetype" + index;
        var replace = "#value" + node;
        if(text == "image") {
            var type = $(this).closest("form").find(divselector).css('display','block');
            $(this).closest("form").find("#photoFile").attr('type','file');   
            $("#typeSectionProduct").val(text);                

        } else if(text == "product"){
            var type = $(this).closest("form").find(divselector).css('display','none');
            $(this).closest("form").find("#photoFile").attr('type','text');        
            $("#typeSectionProduct").val(text);                            
        }

        if(text != "image" && text != "product") {
            var inputtext = $(this).closest("form").find("#indexSectionProduct").val(sectionindex);                        
        }

        
    });

    $("#addSectionMainPanel .dropdown-menu span").click(function(){

        var text = $(this).text().toLowerCase();

        var index = $(this).data('index');
        var node = $(this).data('node');
        var sectionindex = $(this).data('sectionindex');
        var selector = "#mybutton" + index;
        var selector_for_button = "#btntext" + index;
        $(selector).text(text);
        $(selector_for_button).text(text);
        var imagetype = "imagetype";
        var divselector = "#imagetype" + index;
        var replace = "#value" + node;
        if(text == "image") {
            var type = $(this).closest("form").find(divselector).css('display','block');
            $(this).closest("form").find("#photoFile").attr('type','file');   
            $("#typeSectionMainPanel").val(text);                

        } else if(text == "product"){
            var type = $(this).closest("form").find(divselector).css('display','none');
            $(this).closest("form").find("#photoFile").attr('type','text');        
            $("#typeSectionMainPanel").val(text);                            
        }

        if(text != "image" && text != "product") {
            var inputtext = $(this).closest("form").find("#indexSectionMainPanel").val(sectionindex);                        
        }

        
    });



    $("#dropme span").click(function(){

        var text = $(this).text().toLowerCase();

        var index = $(this).data('index');
        var node = $(this).data('node');

        var selector = "#mybutton" + index ;
        var selector_for_button = "#btntext" + index;
        $(selector).text(text);
        $(selector_for_button).text(text);
        var imagetype = "imagetype";
        var divselector = "#imagetype" + index;
        var imgwell = "#imgwell" + index;
        var replace = node == "sectionMainPanel" ? node : "productPanel";
        var replace = "#replace" + replace;
        if(text == "image") {
            $(this).closest("form").find(divselector).css('display','block');
            $(this).closest("form").find(imgwell).css('display','block');
            $(this).closest("form").find("#value").attr('type','file');      
        } else {
            $(this).closest("form").find(divselector).css('display','none');
            $(this).closest("form").find(imgwell).css('display','none');
            $(this).closest("form").find("#value").attr('type','text');      

        }
        $(this).closest("form").find("#type").val(text);      


/*                if(text == "image" && text == "product") {
            alert(text);
        }
else {
            var inputtext = $(this).closest("form").find(":input[type='text']:first").val(sectionindex);                        
        }*/
        
    });

    $("#productSlide").on('click','#submitProductSlide',function () {     

        var index = $(this).data('index');
        var userid = globalUserId;
        var order = $(this).data('order');
        var url = $(this).data('url');
        var value = $(this).closest("form").find("#productSlideValue").val();
        var type = $(this).closest("form").find("#productSlideType").val();
        var password = globalPassword;
        var nodeName = "productSlide";
        if(value == "" || type == "") {
            $("#error").modal('show');
        }
        else {
            var hash = hex_sha1(index+value+type+nodeName+order+userid+password);
            data = { index: index, value: value, type:type, nodename:nodeName,  order:order,  userid: userid, hash:hash, callback:'?'};
            setDataProductSlide(data,order, url);            
        }

    });

    $("#myTabContent").on('click','#productslide',function (e) { 
 
        var index = $(this).data('index');
        var nodename = $(this).data('nodename');
        var nodename = nodename == "map/feedFeaturedProduct/product" ? nodename : (nodename == "map/feedPopularItems/product" ? nodename : "map/feedPromoItems/product");
        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');
        index += 1;
        var hash = hex_sha1(index +nodename + userid + password);
        data = { index: index, nodename:nodename, userid: userid, hash:hash, callback:'?'};         

        $("#loading").modal('show');
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    $("#loading").modal('hide');                        
                    div = nodename == "map/feedFeaturedProduct/product" ? "addFeaturedProduct" : (nodename == "map/feedPopularItems/product" ? "addPopularItemsDiv" : "addfeedPromoItems");
                    load = nodename == "map/feedFeaturedProduct/product" ? "featuredProduct" : (nodename == "map/feedPopularItems/product" ? "popularItem" : "promoItems");
                    div += "#" + div;
                    $("#" + div).load(load);               
                },
                error: function(e) {
                    $("#loading").modal('hide');                    
                    $("#error").modal('show');
      
                }
            });
    }); 

    $("#myTabContent").on('click','#btnRemoveSetSection',function (e) { 
        e.preventDefault();
        var index = $(this).data('index');
        var nodename = $(this).data('nodename');
        var productindex = $(this).data('productindex');
        var userid = globalUserId;
        var password = globalPassword;
        var url = $(this).data('url');

        div = nodename == "product_panel_main" ? "formSetSectionMainPanel" : "formSetSectionProduct";
        div = "#" + div + index + productindex;

        index = (index == 0 ? 1 : index + 1);
        productindex = (productindex == 0 ? 1 : productindex + 1);
                 
        var hash = hex_sha1(index +nodename + userid + productindex + password);
        data = { index: index, nodename:nodename, userid: userid, productindex: productindex, hash:hash, callback:'?'};         

        $("#loading").modal('show');
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    $("#loading").modal('hide');     
                    $(div).remove();                    
                 
      
                },
                error: function(e) {
                    $("#loading").modal('hide');                       
       
      
                }
            });

    }); 

    $("#myTabContent").on('click','#deleteMainSlide',function (e) { 
        e.preventDefault();
        var index = $(this).data('index');
        var nodename = $(this).data('nodename');
        var userid = globalUserId;
        console.log(nodename);
        var password = globalPassword;
        var url = $(this).data('url');
        nodename = nodename == "mainSlide" ? "mainSlide" : "productSlide";   
        index += 1;
        var hash = hex_sha1(index +nodename + userid + password);
        data = { index: index, nodename:nodename, userid: userid, hash:hash, callback:'?'};         

        $("#loading").modal('show');
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    $("#loading").modal('hide');                        
                    div = nodename == "mainSlide" ? "mainSlide" : "productSlide";
                    load = nodename == "mainSlide" ? "slides" : "productslides";
                    div += "#" + div;

                    $("#" + div).load(load);               
                },
                error: function(e) {
                    console.log('success');                    
                    $("#loading").modal('hide');                    
                    $("#error").modal('show');
      
                }
            });

    });    

    function setFeedPopularItems(data,order, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');                
                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {
                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }
                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');   
                }
                else {
                    $("#addPopularItemsDiv").load('popularItem');   
                    $("#loading").modal('hide');                            
                }                
            },
            error: function(e) {
                $("#loading").modal('hide');                
                $("#error").modal('show');
  
            }
        });
    }

    function setFeedPromoItems(data,order, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');
                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');      
                }
                else {
                    $("#addfeedPromoItems").load('promoItems');   
                    $("#loading").modal('hide');
                }                   

            },
            error: function(e) {
                $("#loading").modal('hide');                                
                $("#error").modal('show');
  
            }
        });
    }

    function setFeedFeaturedProduct(data,order, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');
                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');    
                }
                else {
                    $("#addFeaturedProduct").load('featuredProduct'); 
                    $("#loading").modal('hide');
                }                   

            },
            error: function(e) {
                $("#loading").modal('hide');                                
                $("#error").modal('show');
  
            }
        });
    }

    function setSelectNode(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');

                if(json.sites[0]["success"] != "success") {

                    if(json.sites[0]["usererror"]){
                        $("#errorTexts").html(json.sites[0]["usererror"]);
                    }
                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');     
                }
                else {
                    $("#success").modal('show');                   
                }                     
            },
            error: function(e) {
                $("#loading").modal('hide');                                
                $("#error").modal('show');
  
            }
        });
    }

    function setFeedBanner(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                    $("#loading").modal('hide');
                    $("#success").modal('show');
            },
            error: function(e) {
                $("#loading").modal('hide');                                
                $("#error").modal('show');
  
            }
        });
    }

    function addfeedPromoItems(data, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');
                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');     
                }
                else {
                    $("#addfeedPromoItems").load('promoItems');       
                }  
            },
            error: function(e) {
                     $("#error").modal('show');
                     $("#loading").modal('hide');
            }
        });
    }

    function addPopularItem(data, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');
                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');      
                }
                else {
                    $("#addPopularItemsDiv").load('popularItem');           
                }                 
            },
            error: function(e) {
                     $("#error").modal('show');
                     $("#loading").modal('hide');
            }
        });
    }

    function addFeaturedProduct(data, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');
                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');    
                }
                else {
                    $("#addFeaturedProduct").load('featuredProduct');
                }                  

            },
            error: function(e) {
                     $("#error").modal('show');
                     $("#loading").modal('hide');
            }
        });
    }

    function addType(data, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                    $("#mainSlide").load('slides');
            },
            error: function(e) {
                     $("#error").modal('show');
                     $("#loading").modal('hide');
            }
        });
    }                                





    function setDataSectionHead(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {

                    $("type").val(type);
                    $("value").val(value);
                    $("cssclass").val(cssclass);
                    $("layout").val(layout);
                    $("#loading").modal('hide');
                    $("#success").modal('show');

            },
            error: function(e) {

                    $("type").val(type);
                    $("value").val(value);
                    $("cssclass").val(cssclass);
                    $("layout").val(layout);
                    $("#loading").modal('hide');
                    $("#error").modal('show');

            }
        });
    }





    function setPositionProductSlide(data,order, url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {          
                    $("#productSlide").load('productslides');
                    $("#loading").modal('hide');

            },
            error: function(e) {
                    $("#loading").modal('hide');                
                    $("#error").modal('show');
  
            }
        });
    }

    function setDataProductSlide(data,order,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#loading").modal('hide');                  
                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }

                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');     
                }
                else {
                    $("#productSlide").load('productslides'); 
                    $("#loading").modal('hide');                                       
                }                    
            },
            error: function(e) {
                $("#errorTexts").html("Please try again");
                $("#loading").modal('hide');
                $("#customerror").modal('show');
  
            }
        });
    }

    $("#mainSlide").on('click','#submitAddMainSlide',function (e) { 
        e.preventDefault();
        var url = $(this).data('url');
        var value = $("#valueMainSlide").val();
        var myvalue = $("#photoFile").val();
        var mainSlideCoordinate = $("#mainSlideCoordinate").val();
        var mainSlideTarget = $("#mainSlideTarget").val();
        var useridMainSlide = globalUserId;
        var passwordMainSlide = globalPassword;
        var hash = myvalue + value + mainSlideCoordinate + mainSlideTarget + useridMainSlide + passwordMainSlide;
        $("#hashMainSlide").val(hash);

        if( myvalue == "" || myvalue == "undefined" || value == "" || mainSlideCoordinate == "" || mainSlideTarget == "")
        {
            $("#error").modal('show');         
        }
        else
        {
            addMainSlide(url);
        }
    });  

    function addMainSlide(url) {
        $("#loading").modal('show');
        $('#mainSlideForm').ajaxForm({
            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                    $("#mainSlide").load('slides');
                    $("#success").modal('show');                    
            },
            error: function(e) {
                    $("#mainSlide").load('slides');
                    $("#loading").modal('hide');
            }
        }); 
        $('#mainSlideForm').submit();

    }

 $("#mainSlide").on('click','#submit',function () {    
        var index = $(this).data('index');
        var userid = globalUserId;
        var value = $(this).closest("form").find("#photoFile").val();
        var password = globalPassword;
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

        setDataMainSlide(url, data,order,mainSlideForm);
    });    

    function setDataMainSlide(url, data,order, mainSlideForm) {
        $("#loading").modal('show');
        $(mainSlideForm).ajaxForm({
            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                    $("#mainSlide").load('slides');
                    $("#success").modal('show');                    
            },
            error: function(e) {
                    $("#mainSlide").load('slides');
                    $("#loading").modal('hide');
            }
        }); 
        $(mainSlideForm).submit();
/*        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                    $("#mainSlide").load('slides');
            },
            error: function(e) {
                     $("#error").modal('show');
                     $("#loading").modal('hide');
            }
        });*/
    }


    function addDataProductSlide(data,url) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {

                if(json.sites[0]["success"] != "success") {
                    if(json.sites[0]["slugerror"]) {

                        $("#errorTexts").html(json.sites[0]["slugerror"]);         
                    }
                    else if(json.sites[0]["bounds"]){

                        $("#errorTexts").html(json.sites[0]["bounds"]);
                    }
                        $("#customerror").modal('show');     
                        $("#loading").modal('hide');                        
                }
                else {
                    $("#productSlide").load('productslides');  
                    $("#loading").modal('hide');
                }                 
            },
            error: function(e) {
                $("#errorTexts").html("Please try again");
                $("#loading").modal('hide');
                $("#customerror").modal('show');
  
            }
        });
    }



    function setPositionMainSlide(data,order,url) {
        $("#loading").modal('show');

        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                 $("#loading").modal('hide');                
                 $("#mainSlide").load('slides');
            },
            error: function(e) {
                 $("#error").modal('show');  
                 $("#loading").modal('hide');
            }
        });
    }




})(jQuery);


