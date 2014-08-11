$(document).ready(function()
{

    $(document).on('click','#moveup',function () { 

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).data('value');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var order = index;
        var nodename = "mainSlide";

        var hash = hex_sha1(index + userid + value + coordinate + target + order + nodename);
        if(order > 0)
            order = order - 1;
        else
            order = 0;
        data = { index: index, userid: userid, value: value, hash:hash, coordinate:coordinate, target:target, order:order, nodename:nodename, callback:'?'};
        setPositionMainSlide(data,order);
    });


    $(document).on('click','#moveUpProductSlide',function () { 
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var nodeName = "productSlide";
        var value = $(this).data('value');
        var type = $(this).data('type');
        var hash =  hex_sha1(index + userid + order + nodeName + value + type);
        if(order > 0)
            order = order - 1;
        else
            order = 0;
        data = { index: index, userid: userid, hash:hash, order:order, value: value, type:type, nodename:nodeName, callback:'?'};
        setPositionProductSlide(data,order);
    });


    $(document).on('click','#btnSetSectionMainPanel',function () { 
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var productindex = $(this).data('productindex');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var coordinate = $(this).closest("form").find("#coordinate").val();
        var target = $(this).closest("form").find("#target").val();
        var nodeName = "product_panel_main";

        var hash = hex_sha1(index + userid + productindex + type + value + coordinate + target + nodeName);
        data = {index:index , userid:userid, productindex:productindex, hash:hash, type:type, value:value, coordinate:coordinate, target:target, callback:'?'};
        setSectionMainPanel(data);
    });

    $(document).on('click','#btnSetSectionPanel',function () { 
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var productindex = $(this).data('productindex');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();

        var nodeName = "product_panel_main";
        var hash = hex_sha1(index + userid + productindex + type + value + nodeName);
        data = {index:index , userid:userid, productindex:productindex, type:type, hash:hash, value:value, callback:'?'};
        setSectionPanel(data);
    });

    $(document).on('click','#btnAddType',function () { 

        var userid = $(this).data('userid');
        var type = $(this).closest("form").find("#type").val();
        var hash = hex_sha1(userid + type);
        data = {userid:userid, value:type, hash:hash,  callback:'?'};
        addType(data);
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





    $(document).on('click','#moveDownProductSlide',function () { 
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var order = $(this).data('order');
        var nodeName = "productSlide";
        var value = $(this).data('value');
        var type = $(this).data('type');
        var count = $(this).data('count');
        var hash =  hex_sha1(index + userid + order + nodeName + value + type);

        if(order == (count - 1))
            order = order;
        else
            order = order + 1;
        data = { index: index, userid: userid,order:order, hash:hash, value: value, type:type, nodename:nodeName, callback:'?'};
        setPositionProductSlide(data,order);
    });

    $(document).on('click','#submitProductSidebanner', function() {
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

    $(document).on('click','#submitProductSlideTitle', function() {
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
    $(document).on('click','#submitBannerText', function() {
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

    $(document).on('click','#movedown',function () {       

        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).data('value');
        var coordinate = $(this).data('coordinate');
        var target = $(this).data('target');
        var count = $(this).data('count');
        var order = index;
        var nodename = "mainSlide";

        var hash = hex_sha1(index + userid + value + coordinate + target + order + nodename);
        if(order == (count - 1))
            order = order;
        else
            order = order + 1;
        data = { index: index, userid: userid, value: value, hash:hash, coordinate:coordinate, target:target, order:order, nodename:nodename, callback:'?'};
        setPositionMainSlide(data,order);
    });

    $(document).on('click','#submit',function () {       
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var value = $(this).data('value');
        var coordinate = $(this).closest("form").find("#mainSlideCoordinate").val();

        var target = $(this).closest("form").find('#mainSlideTarget').val();
        var count = $(this).data('count');
        var order = index;
        var nodename = "mainSlide";
        var hash = hex_sha1(index + userid + value + coordinate + target + order + nodename);
        data = { index: index, userid: userid, value: value, coordinate:coordinate, hash:hash, target:target, order:order, nodename:nodename, callback:'?'};
        setDataMainSlide(data,order);
    });




    $(document).on('click','#btnSectionHead',function () {      
        var index = $(this).data('index');
        var userid = $(this).data('userid');
        var type = $(this).closest("form").find("#type").val();
        var value = $(this).closest("form").find("#value").val();
        var css_class = $(this).closest("form").find("#cssclass").val();
        var layout = $(this).closest("form").find("#layout").val();
        var title = $(this).closest("form").find("#title").val();

        var hash = hex_sha1(index + userid + type + value + css_class + layout + title);
        data = { index:index , title:title, userid:userid , type:type, value:value, hash:hash, css_class:css_class, layout:layout, callback:'?'};
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

    $(document).on('click','#submitProductSlide',function () {     
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

});