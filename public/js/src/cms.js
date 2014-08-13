(function () {



    $('#myTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
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

        if(order > 0)
            order = order - 1;
        else
            order = 0;
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
        if(order > 0)
            order = order - 1;
        else
            order = 0;
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

        if(order == (count - 1))
            order = order;
        else
            order = order + 1;
        var hash =  hex_sha1(index + nodeName + userid + order + value + type + password);
        data = { index: index, nodename:nodeName, userid: userid, order:order, value: value, type:type, password:password, hash:hash, callback:'?'};
        setPositionProductSlide(data,order);
        
    });


    $("#accordion").on('click','#btnSetSectionMainPanel',function () { 
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

    $("#accordion").on('click','#btnSetSectionPanel',function () { 
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
        var type = $(this).closest("form").find("#type").val();
        var hash = hex_sha1(userid + type);
        data = {userid:userid, value:type, hash:hash,  callback:'?'};
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
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setProductSideBanner",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {
                   $("#loading").modal('hide');
                   $("#success").modal('show');
               }
               else
               {
                    $("#loading").modal('hide');
                    $("#error").modal('show');
               }
            }
        });
    });

    $("#productSlide").on('click','#submitProductSlideTitle', function() {
        $("#loading").modal('show');
        var slidetitle = $("#slidetitle").val();
        var password = $("#adminPassword").val();
        var userid = $("#userId").val();
        var hash = hex_sha1(slidetitle + userid + password);    
        data = { productslidetitle:slidetitle, userid:userid, hash:hash, password:password,  callback: '?'};
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setProductTitle",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {
                    $("#loading").modal('hide');
                    $("#success").modal('show');
 
               }
               else
               {
                    $("#loading").modal('hide');
                    $("#error").modal('show');
               }
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

            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/settext",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {                   
                    $("#loading").modal('hide');
                    $("#success").modal('show');
               }
               else if(d=="error")
               {
                    $("#loading").modal('hide');
                    $("#error").modal('show');
               }
            }
        });
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

        if(order == (count - 1))
            order = order;
        else
            order = order + 1;
        var hash = hex_sha1(index + value + coordinate + target + order + nodename + userid + password);
        data = { index: index, value: value, coordinate:coordinate, target:target, order:order, nodename:nodename,  userid: userid, password:password, hash:hash, callback:'?'};
        setPositionMainSlide(data,order);
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




    $("#accordion").on('click','#btnSectionHead',function () {   

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
        var selector = "#btntext" + index;

        $(selector).text(text);
        var imagetype = "imagetype";
        var divselector = "#imagetype" + index;

        if(text == "Image")
        {
                    var type = $(this).closest("form").find(divselector).css('display','block');

        }
        else
        {
                    var type = $(this).closest("form").find(divselector).css('display','none');
                    $(this).closest("form").find(":input[name='coordinate']").val('');
                    $(this).closest("form").find(":input[name='target']").val('');

        }
        var inputtext = $(this).closest("form").find(":input[type='text']:first").val(text);
        
    });

    function addType(data) {
        $("#loading").modal('show');
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/addType",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {

                    $("#loading").modal('hide');
                    $("#success").modal('show');
               }
               else
               {
                    $("#loading").modal('hide');
                    $("#error").modal('show');
               }
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

    if(error == 1)
    {

        $("#error").modal('show');
      
    }
    else if(success == 1)
    {
        $("#success").modal('show');
    }


    $("#productSlideTitle").on('click','#submitProductSlide',function () {     
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
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setSectionProduct",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {

                    $("#loading").modal('hide');
                    $("#success").modal('show');
               }
               else
               {
                    $("#loading").modal('hide');
                    $("#error").modal('show');
               }
            }
        });
    }  

    function setSectionMainPanel(data) {
        $("#loading").modal('show');
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setsectionmainpanel",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {

                    $("#loading").modal('hide');
                    $("#success").modal('show');
               }
               else
               {
                    $("#loading").modal('hide');
                    $("#error").modal('show');
               }
            }
        });
    }

    function setDataSectionHead(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setsectionhead",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {
                    $("type").val(type);
                    $("value").val(value);
                    $("cssclass").val(cssclass);
                    $("layout").val(layout);
                    $("#loading").modal('hide');
                    $("#success").modal('show');
               }
               else
               {
                    $("type").val(type);
                    $("value").val(value);
                    $("cssclass").val(cssclass);
                    $("layout").val(layout);
                    $("#loading").modal('hide');
                    $("#error").modal('show');
               }
            }
        });
    }



    function setPositionProductSlide(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setproductslide",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {
                    $("#productSlide").load('productslides');
                   
               }
               else
               {
                   
                     $("#error").modal('show');
               }
            }
        });


    }

    function setDataProductSlide(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setproductslide",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {
                   

                    $("#productSlide").load('productslides');
               }
               else
               {
                    $("#error").modal('show');
               }

            }
        });
    }


    function setDataMainSlide(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setmainslide",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {

           
                    $("#mainSlide").load('slides');

               }
               else
               {
                     $("#error").modal('show');
               }
            }
        });
    }


    function setPositionMainSlide(data,order) {
        $("#loading").modal('show');
        $.ajax({
            type: "POST",
            url: "https://easyshop.ph.feature/webservice/homewebservice/setmainslide",
            data: data,
            dataType: "json",
            cache: false,
            success: function(d) {
               if(d=="success")
               {   
                 $("#mainSlide").load('slides');
               }
               else
               {
                 $("#error").modal('show');
               }
            }
        });


    }




})(jQuery);

