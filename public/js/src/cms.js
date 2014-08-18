(function () {

    $.ajaxSetup({
        headers: {
            
        }
    });


    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#AddSectionProduct').on('click','#submitSectionProduct',function (e) { 
        e.preventDefault();
  
        var typeSectionProduct = $("#typeSectionProduct").val();
        var indexSectionProduct = $("#indexSectionProduct").val();
        var valueSectionProduct =  $("#valueSectionProduct").val();
        var productIndexSectionProduct = $("#productIndexSectionProduct").val();
        var userIdSectionProduct = $("#userIdSectionProduct").val();
        var passwordSectionProduct = $("#passwordSectionProduct").val();
        var hash = hex_sha1(typeSectionProduct + indexSectionProduct + valueSectionProduct + productIndexSectionProduct + userIdSectionProduct + passwordSectionProduct);
        $("#hashSectionProduct").val(hash);
        $("#formSectionProduct").submit();
    });   


    $('#addSectionMainPanel').on('click','#submitSectionMainPanel',function (e) { 
        e.preventDefault();
  
        var typeSectionMainPanel = $("#typeSectionMainPanel").val();
        var valueSectionMainPanel = $("#valueSectionMainPanel").val();
        var productindexSectionMainPanel = $("#productindexSectionMainPanel").val();
        var coordinateSectionMainPanel = $("#coordinateSectionMainPanel").val();
        var targetSectionMainPanel = $("#targetSectionMainPanel").val();
        var indexSectionMainPanel = $("#indexSectionMainPanel").val();
        var userIdSectionMainPanel = $("#userIdSectionMainPanel").val();
        var passwordSectionMainPanel = $("#passwordSectionMainPanel").val();
        var hash = hex_sha1(typeSectionMainPanel + indexSectionMainPanel + valueSectionMainPanel + productindexSectionMainPanel + coordinateSectionMainPanel + targetSectionMainPanel + userIdSectionMainPanel + passwordSectionMainPanel);

        $("#hashSectionMainPanel").val(hash);
        $("#formSectionMainPanel").submit();
    });


    $("#mainSlideForm").on('click','#submitAddMainSlide',function (e) { 
        e.preventDefault();
  
        var value = $("#valueMainSlide").val();
        var mainSlideCoordinate = $("#mainSlideCoordinate").val();
        var mainSlideTarget = $("#mainSlideTarget").val();
        var useridMainSlide = $("#userIdMainSlide").val();
        var passwordMainSlide = $("#adminPasswordMainSlide").val();
        var hash = hex_sha1(value + mainSlideCoordinate + mainSlideTarget + useridMainSlide + passwordMainSlide);
        $("#hashMainSlide").val(hash);
        $("#mainSlideForm").submit();
    });   


    $("#productSlide").on('click','#submitAddProduct',function (e) { 
        e.preventDefault();
  
        var value = $("#valueProductSlide").val();
        var userid = $("#userIdProductSlide").val();
        var password = $("#adminPasswordProductSlide").val();
        var hash = hex_sha1(value + userid + password);
              //alert(hash);
        $("#hashProductSlide").val(hash);
        $("#addProductForm").submit();
    });   


    $("#mainSlide").on('click','#movedown',function () {       

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).data('value');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var count = $(this).data('count');
        var password = $(this).data('password');
        var order = index;
        var nodename = "mainSlide";

        if(order == (count - 1)) {
            order = order;
        } else {
             order = order + 1;
        }
        var hash = hex_sha1(index + value + coordinate + target + order + nodename + userid + password);
        data = { index: index, value: value, coordinate:coordinate, target:target, order:order, nodename:nodename,  userid: userid, password:password, hash:hash, callback:'?'};
        setPositionMainSlide(data,order);
    });

    $("#mainSlide").on('click','#moveup',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).data('value');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var password = $(this).data('password');
        var order = index;
        var nodename = "mainSlide";

        if(order > 0) {
            order = order - 1;
        } else {
           order = 0;
        }
            
        var hash = hex_sha1(index + value + coordinate + target + order + nodename + userid + password);
        data = { index: index, value: value,  coordinate:coordinate, target:target, order:order, nodename:nodename, userid: userid, password:password, hash:hash, callback:'?'};
        setPositionMainSlide(data,order);
    });


    $("#productSlide").on('click','#moveUpProductSlide',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var password = $(this).data('password');
        var nodeName = "productSlide";
        var value = $(this).data('value');
        var type = $(this).data('type');      
        
        if(order > 0) {
            order = order - 1;

        } else {
            order = 0;
        }


        var hash =  hex_sha1(index + nodeName + userid + order + value + type + password);
        data = { index: index, nodename:nodeName, userid: userid, hash:hash, order:order, value: value, type:type, password:password,callback:'?'};
        setPositionProductSlide(data,order);
    });

    $("#productSlide").on('click','#moveDownProductSlide',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var password = $(this).data('password');
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
        data = { index: index, nodename:nodeName, userid: userid, order:order, value: value, type:type, password:password, hash:hash, callback:'?'};
        setPositionProductSlide(data,order);
        
    });

    $("#myTabContent").on('click','#btnSetSectionMainPanel',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var productindex = $(this).data('productindex');
        var password = $(this).data('password');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var coordinate = $(this).closest("form").find("#coordinate").val();
        var target = $(this).closest("form").find("#target").val();
        var nodeName = "product_panel_main";

        var hash = hex_sha1(index + type + value + coordinate + target + productindex + nodeName + userid + password);
        data = {index:index , type:type, value:value, coordinate:coordinate, target:target,  productindex:productindex, nodename: nodeName, userid:userid, password:password, hash:hash, callback:'?'};
        setSectionMainPanel(data);
    });


    $("#myTabContent").on('click','#btnSetSectionPanel',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var productindex = $(this).data('productindex');
        var password = $(this).data('password');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();


        var hash = hex_sha1(index + type + productindex + value + userid + password);
        data = {index:index, type:type, productindex:productindex,  value:value, userid:userid, password:password, hash:hash, callback:'?'};
        setSectionPanel(data);
    });

    $("#nodeTypes").on('click','#btnAddType',function () { 

        var userid = $(this).data('userid');
        var password = $(this).data('password');
        var type = $(this).closest("form").find("#type").val();
        var hash = hex_sha1(type + userid + password); 
        
        data = {value:type, userid:userid, password:password, hash:hash,  callback:'?'};
        addType(data);
    });


    $("#productSideBanner").on('click','#submitProductSidebanner', function() {
        $("#loading").modal('show');
        var sidebanner = $("#sidebanner").val();
        var userid = $("#userId").val();
        var password = $("#adminPassword").val();
        var hash = hex_sha1(sidebanner + userid + password);
        data = { value:sidebanner, userid:userid, hash: hash, password:password, callback: '?'};

        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setProductSideBanner',
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
    });


    $("#productSlideTitle").on('click','#submitProductSlideTitle', function() {

        $("#loading").modal('show');
        var slidetitle = $("#slidetitle").val();
        var password = $("#adminPassword").val();
        var userid = $("#userId").val();
        var hash = hex_sha1(slidetitle + userid + password);    
        data = { productslidetitle:slidetitle, userid:userid, hash:hash, password:password,  callback: '?'};

        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setProductTitle',
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
    });

    $("#setText").on('click','#submitBannerText', function() {

        $("#loading").modal('show');
        var bannertext = $("#bannertext").val();
        var userid = $("#userId").val();
        var password = $("#adminPassword").val();
        var string = bannertext + userid + password;
        var hashed = hex_sha1(string);
        data = { value:bannertext , userid:userid, password:password, hash:hashed, callback: '?'};

         $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/settext',
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
    });

    $("#mainSlide").on('click','#submit',function () {       
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).data('value');
        var password = $(this).data('password');
        var coordinate = $(this).closest("form").find("#mainSlideCoordinate").val();
        var target = $(this).closest("form").find('#mainSlideTarget').val();
        var count = $(this).data('count');
        var order = index;
        var nodename = "mainSlide";
        var hash =  hex_sha1(index + value + coordinate + target + order + nodename + userid + password); 
        data = { index: index, value: value, coordinate:coordinate,  target:target, order:order, nodename:nodename,  userid: userid, password:password, hash:hash, callback:'?'};
        setDataMainSlide(data,order);
    });

    $("#myTabContent").on('click','#btnSectionHead',function () {   
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var password = $(this).data('password');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var css_class = $(this).closest("form").find("#cssclass").val();
        var layout = $(this).closest("form").find("#layout").val();
        var title = $(this).closest("form").find("#title").val();
        var hash = hex_sha1(index + type + value + css_class + layout + title + userid + password);
        data = { index:index , type:type, value:value,  css_class:css_class, layout:layout, title:title, userid:userid, password: password, hash:hash, callback:'?'};
        setDataSectionHead(data);
    });


    $(".dropdown-menu span").click(function(){

        var text = $(this).text();
        var index = $(this).data('index');
        var selector = "#mybutton" + index;

        $(selector).text(text);
        var imagetype = "imagetype";
        var divselector = "#imagetype" + index;

        if(text == "Image") {
            var type = $(this).closest("form").find(divselector).css('display','block');

        } else {
            var type = $(this).closest("form").find(divselector).css('display','none');
            $(this).closest("form").find(":input[name='coordinate']").val('');
            $(this).closest("form").find(":input[name='target']").val('');
        }

        var inputtext = $(this).closest("form").find(":input[type='text']:first").val(text);
        
    });

    function addType(data) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/addType',
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

    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    var error = getUrlVars()["error"];
    var success = getUrlVars()["success"];

    if(error == 1){

        $("#error").modal('show');
      
    } 
    else if(success == 1) {
        $("#success").modal('show');
    }

    $("#productSlide").on('click','#submitProductSlide',function () {     

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var value = $(this).closest("form").find("#productSlideValue").val();
        var type = $(this).closest("form").find("#productSlideType").val();
        var password = $(this).closest("form").find("#adminPassword").val();
        var nodeName = "productSlide";
        var hash = hex_sha1(index+value+type+nodeName+order+userid+password);
        data = { index: index, value: value, type:type, nodename:nodeName,  order:order,  userid: userid, password:password,  hash:hash, callback:'?'};
        setDataProductSlide(data,order);
    });

    function setSectionPanel(data) {
        $("#loading").modal('show');
        $.ajax({

            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setSectionProduct',
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

    function setSectionMainPanel(data) {
        $("#loading").modal('show');
        $.ajax({

            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setsectionmainpanel',
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

    function setDataSectionHead(data,order) {
        $("#loading").modal('show');

        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setsectionhead',
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



    function setPositionProductSlide(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setproductslide',
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                    $("#productSlide").load('productslides');
            },
            error: function(e) {
                     $("#error").modal('show');
  
            }
        });


    }

    function setDataProductSlide(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setproductslide',
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                    $("#productSlide").load('productslides');
            },
            error: function(e) {
                    $("#error").modal('show');
  
            }
        });

    }

    function setDataMainSlide(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setmainslide',
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

    function setPositionMainSlide(data,order) {
        $("#loading").modal('show');

        $.ajax({
            type: 'GET',
            url: 'https://easyshop.ph.feature/webservice/homewebservice/setmainslide',
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

            }
        });
    }


    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    var error = getParameterByName('error');
    var success = getParameterByName('success');

    if(error == "1") {
        $("#error").modal('show');
    }
    if(success == "1") {
        $("#success").modal('show');
    }


})(jQuery);


