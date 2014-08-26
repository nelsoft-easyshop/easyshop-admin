(function () {

    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });


    $("#productSlide").on('click','#submitAddProduct',function (e) { 
          
        var value = $(this).closest("form").find("#valueProductSlide").val();
        var userid = $(this).data('userid');
        var password = $(this).data('password');
        var url = $(this).data('url');
        var hash = hex_sha1(value + userid + password);
        data = {value:value, userid:userid , password:password, hash:hash};
        addDataProductSlide(data, url);

    });   

    $('#AddSectionProduct').on('click','#submitSectionProduct',function (e) { 
        e.preventDefault();
  
        var typeSectionProduct = $("#typeSectionProduct").val();
        var indexSectionProduct = $("#indexSectionProduct").val();
        var valueSectionProduct =  $("#valueSectionProduct").val();
        var productIndexSectionProduct = $("#productIndexSectionProduct").val();
        var userIdSectionProduct = $("#userIdSectionProduct").val();
        var passwordSectionProduct = $("#passwordSectionProduct").val();
        var url = $(this).data('url');
        var hash = (typeSectionProduct + indexSectionProduct + valueSectionProduct + productIndexSectionProduct + userIdSectionProduct + passwordSectionProduct);
        data = {type:typeSectionProduct, index:indexSectionProduct, value:valueSectionProduct, productindex:productIndexSectionProduct, userid:userIdSectionProduct, password:passwordSectionProduct, hash:hash};
        AddSectionProduct(data,url);
    });   


    $("#mainSlide").on('click','#submitAddMainSlide',function (e) { 
        e.preventDefault();
        var url = $(this).data('url');
        var value = $("#valueMainSlide").val();
        var myvalue = $("#photoFile").val();
        var mainSlideCoordinate = $("#mainSlideCoordinate").val();
        var mainSlideTarget = $("#mainSlideTarget").val();
        var useridMainSlide = $("#userIdMainSlide").val();
        var passwordMainSlide = $("#adminPasswordMainSlide").val();
        var hash = hex_sha1(myvalue + value + mainSlideCoordinate + mainSlideTarget + useridMainSlide + passwordMainSlide);
        $("#hashMainSlide").val(hash);
        if( myvalue == "" || value == "" || mainSlideCoordinate == "" || mainSlideTarget == "")
        {
                $("#error").modal('show');         
        }
        else
        {
            addMainSlide(url);
        }
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
        var url = $(this).data('url');
        var hash = hex_sha1(typeSectionMainPanel + indexSectionMainPanel + valueSectionMainPanel + productindexSectionMainPanel + coordinateSectionMainPanel + targetSectionMainPanel + userIdSectionMainPanel + passwordSectionMainPanel);

        data = {type:typeSectionMainPanel, index:indexSectionMainPanel, value:valueSectionMainPanel, productindex:productindexSectionMainPanel, coordinate:coordinateSectionMainPanel, target:targetSectionMainPanel, userid:userIdSectionMainPanel,password:passwordSectionMainPanel, hash:hash};
        addSectionMainPanel(data,url);

    });

 


    $("#mainSlide").on('click','#movedown',function () {       

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var password = $(this).data('password');
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
        data = { index: index, value: value, coordinate:coordinate, target:target, order:order, nodename:nodename,  userid: userid, password:password, hash:hash, callback:'?'};
        setPositionMainSlide(data,order, url);
    });

    $("#mainSlide").on('click','#moveup',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).data('value');
        var url = $(this).data('url');
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
        setPositionMainSlide(data,order, url);
    });


    $("#productSlide").on('click','#moveUpProductSlide',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var password = $(this).data('password');
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
        data = { index: index, nodename:nodeName, userid: userid, hash:hash, order:order, value: value, type:type, password:password,callback:'?'};
        setPositionProductSlide(data, order, url);
    });

    $("#productSlide").on('click','#moveDownProductSlide',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var url = $(this).data('url');
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
        setPositionProductSlide(data,order,url);
        
    });

    $("#myTabContent").on('click','#btnSetSectionMainPanel',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var productindex = $(this).data('productindex');
        var password = $(this).data('password');
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var coordinate = $(this).closest("form").find("#coordinate").val();
        var target = $(this).closest("form").find("#target").val();
        var nodeName = "product_panel_main";
        var hash = hex_sha1(index + type + value + coordinate + target + productindex + nodeName + userid + password);
        data = {index:index , type:type, value:value, coordinate:coordinate, target:target,  productindex:productindex, nodename: nodeName, userid:userid, password:password, hash:hash, callback:'?'};
        setSectionMainPanel(data, url);
    });


    $("#myTabContent").on('click','#btnSetSectionPanel',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var productindex = $(this).data('productindex');
        var password = $(this).data('password');
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();

        var hash = hex_sha1(index + type + productindex + value + userid + password);
        data = {index:index, type:type, productindex:productindex,  value:value, userid:userid, password:password, hash:hash, callback:'?'};
        setSectionPanel(data, url);
    });

    $("#nodeTypes").on('click','#btnAddType',function () { 

        var userid = $(this).data('userid');
        var password = $(this).data('password');
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var hash = hex_sha1(type + userid + password); 
        
        data = {value:type, userid:userid, password:password, hash:hash,  callback:'?'};
        addType(data, url);
    });


    $("#productSideBanner").on('click','#submitProductSidebanner', function() {
        $("#loading").modal('show');
        var sidebanner = $("#sidebanner").val();
        var url = $(this).data('url');
        var userid = $("#userId").val();
        var password = $("#adminPassword").val();
        var hash = hex_sha1(sidebanner + userid + password);
        data = { value:sidebanner, userid:userid, hash: hash, password:password, callback: '?'};

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
    });


    $("#productSlideTitle").on('click','#submitProductSlideTitle', function() {

        $("#loading").modal('show');
        var slidetitle = $("#slidetitle").val();
        var password = $("#adminPassword").val();
        var userid = $("#userId").val();
        var url = $(this).data('url');
        var hash = hex_sha1(slidetitle + userid + password);    
        data = { productslidetitle:slidetitle, userid:userid, hash:hash, password:password,  callback: '?'};

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
    });

    $("#setText").on('click','#submitBannerText', function() {
        $("#loading").modal('show');
        var url = $(this).data('url');
        var bannertext = $("#bannertext").val();
        var userid = $("#userId").val();
        var password = $("#adminPassword").val();
        var string = bannertext + userid + password;
        var hashed = hex_sha1(string);
        data = { value:bannertext , userid:userid, password:password, hash:hashed, callback: '?'};

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
    });

    $("#mainSlide").on('click','#submit',function () {       
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).closest("form").find("#mainSlideValue").val();
        var password = $(this).data('password');
        var coordinate = $(this).closest("form").find("#mainSlideCoordinate").val();
        var target = $(this).closest("form").find('#mainSlideTarget').val();
        var count = $(this).data('count');
        var url = $(this).data('url');
        var order = index;
        var nodename = "mainSlide";
        var hash =  hex_sha1(index + value + coordinate + target + order + nodename + userid + password);
        data = { index: index, value: value, coordinate:coordinate,  target:target, order:order, nodename:nodename,  userid: userid, password:password, hash:hash, callback:'?'};
        setDataMainSlide(url, data,order);
    });

    $("#myTabContent").on('click','#btnSectionHead',function () {   
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var password = $(this).data('password');
        var url = $(this).data('url');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var css_class = $(this).closest("form").find("#cssclass").val();
        var layout = $(this).closest("form").find("#layout").val();
        var title = $(this).closest("form").find("#title").val();
        var hash = hex_sha1(index + type + value + css_class + layout + title + userid + password);
        data = { index:index , type:type, value:value,  css_class:css_class, layout:layout, title:title, userid:userid, password: password, hash:hash, callback:'?'};
        setDataSectionHead(data, url);
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
        }

        var inputtext = $(this).closest("form").find(":input[type='text']:first").val(text);
        
    });

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

    $("#productSlide").on('click','#submitProductSlide',function () {     

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var url = $(this).data('url');
        var value = $(this).closest("form").find("#productSlideValue").val();
        var type = $(this).closest("form").find("#productSlideType").val();
        var password = $(this).closest("form").find("#adminPassword").val();
        var nodeName = "productSlide";
        var hash = hex_sha1(index+value+type+nodeName+order+userid+password);
        data = { index: index, value: value, type:type, nodename:nodeName,  order:order,  userid: userid, password:password,  hash:hash, callback:'?'};
        setDataProductSlide(data,order, url);
    });

    function setSectionPanel(data, url) {
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

    function setSectionMainPanel(data, url) {
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

    function addSectionMainPanel(data,url) {
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
            },
            error: function(e) {
                    $("#error").modal('show');
  
            }
        });
    }

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
            },
            error: function(e) {
                    $("#mainSlide").load('slides');
                     $("#loading").modal('hide');
            }
        }); 
        $('#mainSlideForm').submit();

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
            },
            error: function(e) {
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
                    $("#productSlide").load('productslides');
            },
            error: function(e) {
                    $("#error").modal('show');
  
            }
        });
    }

    function setDataMainSlide(url, data,order) {
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
                    $("#productSlide").load('productslides');
            },
            error: function(e) {
                    $("#error").modal('show');
  
            }
        });
    }

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
                    $("#productSlide").load('productslides');
            },
            error: function(e) {
                    $("#error").modal('show');
  
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
                 $("#mainSlide").load('slides');
            },
            error: function(e) {
                 $("#error").modal('show');  
            }
        });
    }




})(jQuery);


