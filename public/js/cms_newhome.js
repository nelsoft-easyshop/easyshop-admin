(function () {
    var userid = $("#userid").val();
    var password = $("#password").val();

    $(document.body).on('click','#addSubCategorySection',function (e) { 
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val();
        var subCategoryText = $(this).closest("form").find("#subCategoryText").val();
        var subCategorySectionTarget = $(this).closest("form").find("#subCategorySectionTarget").val();
        var url = $(this).data('url');
        var hash =  hex_sha1(index + subCategoryText + subCategorySectionTarget + userid + password);
        data = { index: index, subCategoryText:subCategoryText, subCategorySectionTarget:subCategorySectionTarget, userid:userid,  password:password, hash:hash, callback:'?'};

        var tableSelector = "#subCategoriesSection_" + index;
        var reloadurl = "getSubCategoriesSection/" + index;

        if($.trim(subCategoryText) == "" || $.trim(subCategorySectionTarget) == "") {
            showErrorModal("Please enter values to the required fields");
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
                    $(tableSelector).load(reloadurl);
                    loader.hidePleaseWait();  
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });  
        }     
    });  

    $(document.body).on('click','.editCategorySection',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);

        $("#edit_categoryText_index").val(data.categorySectionIndex);
        $("#edit_categoryText_subIndex").val(data.subCategorySectionIndex);
        $("#edit_categoryText_url").val(data.url);
        $("#edit_categoryText").val(data.value);
        $("#edit_categoryTarget").val(data.target);

    });  

    $(document.body).on('click','#setSubCategoriesSectionBtn',function (e) { 
        loader.showPleaseWait();          
        var index = $("#edit_categoryText_index").val().toString();
        var subIndex = $("#edit_categoryText_subIndex").val().toString();
        var url = $("#edit_categoryText_url").val().toString();
        var text = $("#edit_categoryText").val().toString();
        var target = $("#edit_categoryTarget").val().toString();


        var hash =  hex_sha1(index + subIndex + text + target + userid + password);
        data = { index: index, subIndex:subIndex, text:text, target:target, userid:userid,  password:password, hash:hash, callback:'?'};

        var tableSelector = "#subCategoriesSection_" + index;
        var reloadurl = "getSubCategoriesSection/" + index;

        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $(tableSelector).load(reloadurl);
                loader.hidePleaseWait();  
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });       

    });      

    $(document.body).on('click','#editCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
        var value = $(this).closest("form").find("#value").val().toString();
        var index = $(this).closest("form").find("#index").val().toString();
        var subindex = $(this).closest("form").find("#subindex").val().toString();
        var url = $(this).data("url");

        var hash =  hex_sha1(index + value + subindex + userid + password);
        data = { index: index, value:value, subindex:subindex, userid:userid, password:password, hash:hash, callback:'?'};

        var tableSelector = "#categorySectionProductPanel_" + index;
        var reloadurl = "getCategoriesProductPanel/" + index;

        if($.trim(value) == "") {
            showErrorModal("Please supply a slug");
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
                    $(tableSelector).load(reloadurl);
                    loader.hidePleaseWait();  
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            });  
        }
    
    });     

    $(document.body).on('click','#moveupCategoryProductPanel, #movedownCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
        var action = $(this).data('action').toString();
        var subindex = $(this).data('subindex').toString();
        var index = $(this).data('index').toString();
        var order = parseInt($(this).data('order'));
        var url = $(this).data('url').toString();
        var count = parseInt($(".categoryProductPanelCount").last().text());

        var tableSelector = "#categorySectionProductPanel_" + index;
        var reloadurl = "getCategoriesProductPanel/" + index;
        if(action == "down") {
            if(order == (count - 1)) {
                order = order;
            } else {
                 order = order + 1;
            }           
        }
        else {
            if(order > 0) {
                order = order - 1;
            } else {
               order = 0;
            }
    
        }
        order = order.toString();
        var hash =  hex_sha1(index + subindex  + order + userid + password);        
        data = { index: index, subIndex:subindex, order:order, userid:userid,  password:password, hash:hash, callback:'?'};
        setCategoryProductPosition(url,data, tableSelector, reloadurl);
    
    }); 

    $(document.body).on('click','#removeCategoryProductPanel',function (e) { 
        var index = $(this).data("index").toString();
        var subindex = $(this).data("subindex").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");
        var hash = hex_sha1(index + subindex  + nodename + userid + password);

        data = { index: index, subIndex:subindex,nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};  
        var count = parseInt($(".categoryProductPanelCount_"+index).last().text());        
        var tableSelector = "#categorySectionProductPanel_" + index;
        var reloadurl = "getCategoriesProductPanel/" + index;
        if(count > 1 ) {
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
                    $(tableSelector).load(reloadurl);                  
                    loader.hidePleaseWait();
                       
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            });    
        }          
    });  


    $(document.body).on('click','#moveup, #movedown',function (e) { 
        loader.showPleaseWait();          
        var action = $(this).data('action').toString();
        var subindex = $(this).data('subindex').toString();
        var index = $(this).data('index').toString();
        var order = parseInt($(this).data('order'));
        var url = $(this).data('url').toString();
        var count = parseInt($(".slideCount").last().text());
        if(action == "down") {
            if(order == (count - 1)) {
                order = order;
            } else {
                 order = order + 1;
            }           
        }
        else {
            if(order > 0) {
                order = order - 1;
            } else {
               order = 0;
            }
    
        }
        order = order.toString();
        var hash =  hex_sha1(index + subindex  + order + userid + password);        
        data = { index: index, subIndex:subindex, order:order, userid:userid,  password:password, hash:hash, callback:'?'};
        setSliderPosition(url,data);
    
    }); 


    $(document.body).on('click','#moveupAdsSection, #movedownAdsSection',function (e) { 
        loader.showPleaseWait();          
        var action = $(this).data('action').toString();
        var index = $(this).data('index').toString();
        var order = parseInt($(this).data('order'));
        var url = $(this).data('url').toString();
        var count = parseInt($(".adsCount").last().text());
        if(action == "down") {
            if(order == (count - 1)) {
                order = order;
            } else {
                 order = order + 1;
            }           
        }
        else {
            if(order > 0) {
                order = order - 1;
            } else {
               order = 0;
            }
    
        }
        order = order.toString();
        var hash =  hex_sha1(index  + order + userid + password);        
        data = { index: index, order:order, userid:userid,  password:password, hash:hash, callback:'?'};
        setPositionAdsSection(url,data);
    
    }); 

    $(document.body).on('click','#addCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
        var value = $(this).closest("form").find("#value").val().toString();
        var index = $(this).data("index");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + value  + userid + password);
        data = { index: index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};

        var tableSelector = "#categorySectionProductPanel_" + index;
        var reloadurl = "getCategoriesProductPanel/" + index;
        if($.trim(value) == "") {
            showErrorModal("Please supply a slug");
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
                    loader.hidePleaseWait();  
                    $(tableSelector).load(reloadurl);
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            }); 
        }      
    });  

    $(document.body).on('click','.removeCategorySection',function (e) { 
        loader.showPleaseWait();          
        var index = $(this).data("index").toString();
        var subIndex = $(this).data("subindex").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + subIndex + nodename + userid + password);
        data = { index: index, subIndex:subIndex, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};

        var tableSelector = "#subCategoriesSection_" + index;
        var reloadurl = "getSubCategoriesSection/" + index;

        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $(tableSelector).load(reloadurl);
                loader.hidePleaseWait();  
            },
            error: function(e) {
                loader.hidePleaseWait();
                showErrorModal("Please try again");
            }
        });       

    });  



    $(document.body).on('click','#setMainNavigation',function (e) { 
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val();
        var categoryName = $(this).closest("form").find("#drop_actionType").val();
        var url = $(this).data('url');
        var prev = $(this).data('prev');
        var hash =  hex_sha1(index + categoryName + userid + password);
        data = { index: index, value:categoryName, userid:userid,  password:password, hash:hash, callback:'?'};
        var count = $('.mainNavigation_'+categoryName).length;
        if(count > 0) {
            loader.hidePleaseWait();
            showErrorModal("Main category already exists");
        }
        else {
            $(this).closest("form").closest("div").attr("id","navigation_" + categoryName); 
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
                    $("#mainNavigation_"+index).html(categoryName);
                    $("#mainNavigation_"+index).attr("href","#navigation_" + categoryName);
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });        
        }

    });  


    $(document.body).on('click','#editAdsSection',function (e) { 
        loader.showPleaseWait();
        var index = $(this).closest("form").find("#index").val().toString();
        var url = $(this).data('url');
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();     
        var target = $(this).closest("form").find("#target").val().toString();
        target = target == "" ? "/" : target;
        var hash =  hex_sha1(index + userid + value + target  + password);
        var form = "#adSectionForm"+index;
        $(this).closest("form").find("#editAdsSectionHash").val(hash);
        editAdsSectionForm(form, url);

    }); 



    $(document.body).on('click','#editSubSlider',function (e) { 

        var index = $(this).closest("form").find("#index").val().toString();
        var subIndex = $(this).closest("form").find("#subIndex").val().toString();
        var url = $(this).data('url');
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();     
        var target = $(this).closest("form").find("#target").val().toString();
        target = target == "" ? "/" : target;
        var hash =  hex_sha1(index + subIndex + userid + value + target  + password);
        $(this).closest("form").find("#editHashMainSlide").val(hash);

        var editSlideForm_ = "#editSlideForm_"+index+"_"+subIndex;

        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;

        editSubSlider(editSlideForm_, url, tableSelector, reloadurl);

    }); 


    $(document.body).on('click', '#addAdSection',function (e) { 
        
        loader.showPleaseWait();     
        var url = $(this).data('url');
        var userid = $(this).closest("form").find("#userid").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();   
        var password = $(this).closest("form").find("#password").val().toString();
        var hash =  hex_sha1(userid  + value + password);        
        $(this).closest("form").find("#hashAddAds").val(hash);
        var form = "#addAdsForm";
        if(value == "") {
            showErrorModal("Please upload na Image");
        }
        else {
            addAds(form, url);
        }
    }); 

    $(document.body).on('click','#changeSellerBannerSubmit, #changeSellerLogoSubmit, #changeSellerSlug',function (e) { 
        
        loader.showPleaseWait();     
        var url = $(this).data('url');
        var action = $(this).closest("form").find("#action").val().toString();
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        if(action == "slug") {
            var slug = $(this).closest("form").find("#slug").val().toString();
            if($.trim(slug) == "") {
                loader.hidePleaseWait();                  
                showErrorModal("Please enter a valid slug");
            }
            else {
                    var hash =  hex_sha1(slug + action + userid + password);
                    data = { slug:slug, action:action, userid:userid,  password:password, hash:hash, callback:'?'};
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
                        },
                        error: function(e) {
                            loader.hidePleaseWait();
                        }
                    });    
            }
        }
        else {

            var value = $(this).closest("form").find("#photoFile").val().toString();     
            var hash =  hex_sha1(userid +  value + action + password);
            var form = "";
            if(action == "banner") {
                $(this).closest("form").find("#hashChangeSellerBanner").val(hash);
                var form = "#changeSellerBannerForm";
            }
            else if(action == "logo"){
                $(this).closest("form").find("#hashChangeSellerLogo").val(hash);
                var form = "#changeSellerLogoForm";            
            }

            if(value == "") {
                showErrorModal("Please upload na Image");
            }
            else {
                changeSellerBanner(form, url);
            }
        }


    }); 


    $(document.body).on('click','#editProductPanel',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $(this).closest("form").find("#value").val();   
        var index = $(this).closest("form").find("#index").val();   
        var hash =  hex_sha1(index  + value + userid + password);
        data = { index: index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        if($.trim(value) == "") {
            showErrorModal("Please supply a slug");
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
                    $("#productPanelDiv").load("getProductPanel");                         
                    loader.hidePleaseWait();   
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });
        }
    }); 

    $(document.body).on('click','#addProductPanel',function (e) { 
        
        loader.showPleaseWait();          
        var value = $(this).closest("form").find("#value").val();
        var url = $(this).data('url');
        var hash =  hex_sha1( userid + value + password);
        data = { userid:userid, value:value,  password:password, hash:hash, callback:'?'};

        if($.trim(value) == "") {
            showErrorModal("Please supply a valid slug");
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
                    $("#productPanelDiv").load("getProductPanel");                     
                    loader.hidePleaseWait();  
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });  
        }
    });  


    $(document.body).on('click','#removeAdsSection',function (e) { 
            
        var index = $(this).data("index");
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index  + nodename + userid + password);

        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};  
        var count = parseInt($(".adsCount").last().text());
        if(count > 1 ) {
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
                    $("#adsSectionDiv").load("getAdsSection");                        
                    loader.hidePleaseWait();
                       
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            });    
        }        
          
      
    });

    $(document.body).on('click','#movedownProductPanel, #moveupProductPanel',function (e) { 
        loader.showPleaseWait();          
        var action = $(this).data('action').toString();
        var index = $(this).data('index').toString();
        var order = parseInt($(this).data('order'));
        var url = $(this).data('url').toString();
        var count = parseInt($(".productPanelCount").last().text());
        if(action == "down") {
            if(order == (count - 1)) {
                order = order;
            } else {
                 order = order + 1;
            }           
        }
        else {
            if(order > 0) {
                order = order - 1;
            } else {
               order = 0;
            }
    
        }
        order = order.toString();
        var hash =  hex_sha1(index  + order + userid + password);        
        data = { index: index, order:order, userid:userid,  password:password, hash:hash, callback:'?'};
        setPositionProductPanel(url,data);
    
    });  

  

    $(document.body).on('click','#addSubSlider',function (e) { 
        
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val().toString();
        var url = $(this).data('url');
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();     
        var target = $(this).closest("form").find("#target").val().toString();
        target = $.trim(target) == "" ? "/" : target;
        var hash =  (index + userid+ value + target  + password);
        var hash =  hex_sha1(index + userid+ value + target  + password);
        $(this).closest("form").find("#hashMainSlide").val(hash);
        var mainSlideForm = "#mainSlideForm"+index;

        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;
        if(value == "") {
            showErrorModal("Please upload na Image")
        }
        else {
            addSubSlider(mainSlideForm, url, tableSelector, reloadurl);
        }

    });  

    $(document.body).on('click','#addMainSlider',function (e) { 
        loader.showPleaseWait();          
        var template = $(this).closest("form").find("#drop_actionType").val();
        var url = $(this).data('url');
        var hash =  hex_sha1(template + userid + password);
        data = { template:template, userid:userid,  password:password, hash:hash, callback:'?'};
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#manageSliderSection").load("getAllSliders");
                loader.hidePleaseWait();   
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });        


    });  
    $(document.body).on('click','.removeButton',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        var index = data.index.toString();
        var subIndex = data.subIndex.toString();
        var url = data.url;
        var nodename = "categorySubSlug";
        var hash =  hex_sha1(index + subIndex + nodename + userid + password);
        data = { index: index, subIndex:subIndex, nodename:nodename,userid:userid,  password:password, hash:hash, callback:'?'};  
        var subcategories = "#subcategories_" + index;
        var count = $(subcategories + " tbody tr").length;
        var editCategoryLink = $("#editCategoryLink").val();
        var removeCategoryLink = $("#removeCategoryLink").val();

        if(count > 1 ) {
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
                    $("#row_"+index+"_"+subIndex).remove();

                    var rowCount = 0;
                    $(subcategories + " tbody tr").each(function(){
                        var editBtnData = $(this).find(".edit_btn").attr("data");
                        var valueRow = $(this).find(".subCategoryTD").text;
                        var dataJSON = $.parseJSON(editBtnData);
                        var obj1 = '{"url":"' + editCategoryLink +
                            '","index":"' +  index +
                            '","subIndex":"' + rowCount +
                            '","value":"' +dataJSON.value +'"}';
                        var obj2= '{"url":"' + removeCategoryLink +
                            '","index":"' +  index +
                            '","subIndex":"' + rowCount +
                            '","value":"' +dataJSON.value +'"}';                            
                        $(this).attr("id","row_"+index+"_"+rowCount);
                        $(this).find(".subCategoryTD").attr("id","value_"+index+"_"+rowCount);
                        $(this).find(".edit_btn").attr("data",obj1);
                        $(this).find(".removeButton").attr("data",obj2);
                        $(this).find(".edit_btn").attr("id","data_"+index + "_"+rowCount);
                        rowCount++;
                        
                    });                    
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }        
    }); 


    $(document.body).on('click','#removeProductPanel',function (e) { 
        var index = $(this).data("index");
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index  + nodename + userid + password);

        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};  
        var count = parseInt($(".productPanelCount").last().text());
        if(count > 1 ) {
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
                    $("#productPanelDiv").load("getProductPanel");                    
                    loader.hidePleaseWait();
                       
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            });    
        }        
          
      
    });  

    $(document.body).on('click','#removeSubSlide',function (e) { 
            
        var index = $(this).data("index").toString();
        var subindex = $(this).data("subindex").toString();
        var nodename = $(this).data("nodename").toString();
        var url = $(this).data("url");
        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;
        var hash =  hex_sha1(index + subindex + nodename + userid + password);

        data = { index: index, subIndex:subindex, nodename:nodename,userid:userid,  password:password, hash:hash, callback:'?'};  
        var count = parseInt($(".slideCount_" + index).last().text());

        if(count > 1 ) {
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
                    $(tableSelector).load(reloadurl);                  
                    loader.hidePleaseWait();
                       
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            });    
        }        
    });  


    $(document.body).on('click','.btn-danger',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#edit_url").val(data.url);
        $("#edit_index").val(data.index);
        $("#edit_subIndex").val(data.subIndex);
        $('#drop_actionTypeEdit option[value="'+ data.value +'"]').attr("selected", "selected");
    });  

    $(document.body).on('click','#removeCategorySection, #removeMainSlider',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var nodename = $(this).data("nodename");
        var index = $(this).data("index").toString();
        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index:index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};
        
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
                if(nodename == "categorySectionPanel") {
                    $("#manageCategorySection").load("getCategoriesPanel");
                }
                else {
                    $("#manageSliderSection").load("getAllSliders");
                }
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });   
    }); 

    $(document.body).on('click','#addCategorySectionProductPanel',function (e) { 
        loader.showPleaseWait();           
        var value = $('#addCategorySectionValue option:selected').val();
        var url = $(this).data("url");
        var hash =  hex_sha1(value + userid + password);
        data = { value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        
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
                $("#manageCategorySection").load("getCategoriesPanel");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });   
    });   

    $(document.body).on('click','.removeNewArrival',function (e) { 
     
        var index = $(this).data("index").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".newArrivalsCount").last().text());
 
        if(count > 1) {
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
                    $("#newArrivalsTable").load("getNewArrivals");
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }     
    });  


    $(document.body).on('click','#addTopSellers',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $(this).closest("form").find("#value").val();
        var hash =  hex_sha1(value + userid + password);
        data = {value:value, userid:userid,  password:password, hash:hash, callback:'?'};

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
                $("#addTopSellersTable").load("getTopSellers");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
    }); 

    $(document.body).on('click','#addTopProducts',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $(this).closest("form").find("#value").val();
        var hash =  hex_sha1(value + userid + password);
        data = {value:value, userid:userid,  password:password, hash:hash, callback:'?'};

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
                $("#addTopProductsTable").load("getTopProducts");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
    });   
    $(document.body).on('click','.removeTopProducts',function (e) { 
     
        var index = $(this).data("index").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".topProductsCount").last().text());
        if(count > 1) {
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
                    $("#addTopProductsTable").load("getTopProducts");
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }     
    });   

    $(document.body).on('click','.removeTopSellers',function (e) { 
     
        var index = $(this).data("index").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".topSellersCount").last().text());
        if(count > 1) {
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
                    $("#addTopSellersTable").load("getTopSellers");
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }     
    });    

    $(document.body).on('click','#addNewArrival',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $(this).closest("form").find("#value").val();
        var target = $(this).closest("form").find("#target").val();
        var hash =  hex_sha1(value + target + userid + password);
        data = {value:value, target:target, userid:userid,  password:password, hash:hash, callback:'?'};

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
                $("#newArrivalsTable").load("getNewArrivals");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          

    });      


    $(document.body).on('click','#addOtherCategoy',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $('#drop_otherCategories option:selected').val();      
        var hash =  hex_sha1(value + userid + password);
        data = {value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        
        var flag = 0;
        var count = parseInt($(".otherCategoriesCount").last().text());
        console.log(count);
        if(count <= 5) {
            $("#otherCategoriesTable" + " tbody tr").each(function(){
                var valueRow = $(this).find(".otherCategoriesTD").text();
                if(valueRow == value) {
                    flag = 1;
                }
            }); 
            if(flag == 0) {
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
                        $("#otherCategoriesTable").load("getOtherCategories");
                    },
                    error: function(e) {
                        loader.hidePleaseWait();
                    }
                });          
            }
            else {
                showErrorModal("Category already exists");
            }            
        }
        else {
            showErrorModal("There are already " + count  +" other categories");
        }
    });  

    $(document.body).on('click','#editOtherCategorySubmit',function (e) { 
        loader.showPleaseWait();           
        var index = $(this).closest("form").find("#editOtherIndex").val();
        var url = $(this).closest("form").find("#editOtherUrl").val();
        var value = $('#drop_otherCategories_edit option:selected').val();      
        var hash =  hex_sha1(index + value + userid + password);
        data = {index:index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};

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
                $("#otherCategoriesTable").load("getOtherCategories");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          

        
    });  

    $(document.body).on('click','#editTopSellersSubmit',function (e) { 
        loader.showPleaseWait();           
        var index = $(this).closest("form").find("#editTopSellersIndex").val();
        var url = $(this).closest("form").find("#editTopSellersUrl").val();
        var value = $(this).closest("form").find("#editTopSellersValue").val();     
        var hash =  hex_sha1(index + value + userid + password);
        data = {index:index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};

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
                $("#addTopSellersTable").load("getTopSellers");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
        
    }); 

    $(document.body).on('click','#editTopProductsSubmit',function (e) { 
        loader.showPleaseWait();           
        var index = $(this).closest("form").find("#editTopProductsIndex").val();
        var url = $(this).closest("form").find("#editTopProductsUrl").val();
        var value = $(this).closest("form").find("#editTopProductsValue").val();     
        var hash =  hex_sha1(index + value + userid + password);
        data = {index:index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};

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
                $("#addTopProductsTable").load("getTopProducts");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
        
    }); 

    $(document.body).on('click','#editNewArrivalSubmit',function (e) { 
        loader.showPleaseWait();           
        var index = $(this).closest("form").find("#editNewArrivalIndex").val();
        var url = $(this).closest("form").find("#editNewArrivalUrl").val();
        var value = $(this).closest("form").find("#editNewArrivalValue").val();     
        var target = $(this).closest("form").find("#editNewArrivalTarget").val();     
        var hash =  hex_sha1(index + value + target + userid + password);
        data = {index:index, value:value, target:target, userid:userid,  password:password, hash:hash, callback:'?'};

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
                    $("#newArrivalsTable").load("getNewArrivals");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
        
    });  
    $(document.body).on('click','#editTopSellersBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#editTopSellersValue").val(data.value);
        $("#editTopSellersIndex").val(data.index);
        $("#editTopSellersUrl").val(data.url);

    });  

    $(document.body).on('click','#editTopProductsBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#editTopProductsValue").val(data.value);
        $("#editTopProductsIndex").val(data.index);
        $("#editTopProductsUrl").val(data.url);

    });  

    $(document.body).on('click','#editNewArrivalBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#editNewArrivalValue").val(data.value);
        $("#editNewArrivalTarget").val(data.target);
        $("#editNewArrivalIndex").val(data.index);
        $("#editNewArrivalUrl").val(data.url);

    });  

    $(document.body).on('click','#editOtherCategoryBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $('#drop_otherCategories_edit option[value="'+ data.value +'"]').attr("selected", "selected");
        $("#editOtherIndex").val(data.index);
        $("#editOtherUrl").val(data.url);

    });     

    $(document.body).on('click','.removeOtherCategory',function (e) { 
     
        var index = $(this).data("index").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".otherCategoriesCount").last().text());
 
        if(count > 1) {
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
                    $("#otherCategoriesTable").load("getOtherCategories");
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }     

    });  

    $(document.body).on('click','#mdl_save',function (e) { 
        loader.showPleaseWait();           
        var url = $("#edit_url").val();
        var index = $("#edit_index").val().toString();
        var subIndex = $("#edit_subIndex").val().toString();
        var value = $('#drop_actionTypeEdit option:selected').val();      
        var hash =  hex_sha1(index + subIndex + value + userid + password);
        data = { index: index, subIndex:subIndex, value:value, userid:userid,  password:password, hash:hash, callback:'?'};

        var flag = 0;

        $("#subcategories_" + index + " tbody tr").each(function(){
            var valueRow = $(this).find(".subCategoryTD").text();
            if(valueRow == value) {
                flag = 1;
            }
        }); 

        if(flag == 0) {
              $.ajax({
                type: 'GET',
                url: url,
                data:data,
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    updateDateContainer(index, subIndex, value, url);
                    loader.hidePleaseWait();   
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });          
        }
        else {
            showErrorModal("Sub category already exists");
        }


    });      



    $(document.body).on('click','#setSliderDesignTemplate',function (e) { 
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val();
        var value = $(this).closest("form").find("#drop_actionType option:selected").val();
        var url = $(this).data("url");
        var hash = hex_sha1(index + value + userid + password);
        data = { index: index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        console.log(hash);

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
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });     
   
    });  

    $(document.body).on('click','#addSubCategoryNavigation',function (e) { 
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val();
        var categoryName = $(this).closest("form").find("#drop_actionType option:selected").val();

        var url = $(this).data('url');
        var subcategories = $(this).data('subcategories');
        var hash =  hex_sha1(index + categoryName + userid + password);
        data = { index: index, value:categoryName, userid:userid,  password:password, hash:hash, callback:'?'};
        var count = $(subcategories + " tbody tr").length;
        subIndex = count;
        var newSubIndex = count + 1;
        var flag = 0;

        var editCategoryLink = $("#editCategoryLink").val();
        var removeCategoryLink = $("#removeCategoryLink").val();
        $(subcategories + " tbody tr").each(function(){
            var valueRow = $(this).find(".subCategoryTD").text();
            if(valueRow == categoryName) {
                flag = 1;
            }
        }); 
        if(count >= 4) {
            loader.hidePleaseWait();                
            showErrorModal("Only 4 Sub Categories are allowed");
        }
        else {
            if(flag == 1) {
                showErrorModal("Sub category already exists");
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
                        loader.hidePleaseWait();                       
                        appendDataContainer(index, newSubIndex, subIndex, categoryName, url, removeCategoryLink, editCategoryLink);
                    },
                    error: function(e) {
                        loader.hidePleaseWait();
                    }
                });       
            }
        }

    });  


    function setCategoryProductPosition(url,data, tableSelector, reloadurl)
    {

        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $(tableSelector).load(reloadurl);
                loader.hidePleaseWait();  
            },
            error: function(e) {
                loader.hidePleaseWait();
                showErrorModal("Please try again");
            }
        });  
    }


    function setSliderPosition(url,data)
    {
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#manageSliderSection").load("getSlideSection");    
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $("#manageSliderSection").load("getSlideSection");   
                loader.hidePleaseWait();                   
            }
        }); 
    }    

    function setPositionAdsSection(url,data)
    {
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#adsSectionDiv").load("getAdsSection");      
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $("#adsSectionDiv").load("getAdsSection");     
                loader.hidePleaseWait();                   
            }
        }); 
    }

    function setPositionAdsSection(url,data)
    {
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#adsSectionDiv").load("getAdsSection");      
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $("#adsSectionDiv").load("getAdsSection");     
                loader.hidePleaseWait();                   
            }
        }); 
    }

    function editAdsSectionForm(form,url)
    {
        $(form).ajaxForm({

            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#adsSectionDiv").load("getAdsSection");                
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $("#adsSectionDiv").load("getAdsSection");          
                loader.hidePleaseWait();   
            }
        }); 
        $(form).submit(); 
    }

    function editSubSlider(editSlideForm_, url, tableSelector, reloadurl)
    {
        $(editSlideForm_).ajaxForm({

            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $(tableSelector).load(reloadurl);                
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $(tableSelector).load(reloadurl);                
                loader.hidePleaseWait();   
            }
        }); 
        $(editSlideForm_).submit(); 
    }


    function addAds(form, url)
    {
        $(form).ajaxForm({

            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#adsSectionDiv").load("getAdsSection");                  
                loader.hidePleaseWait();  
            },
            error: function(e) {
                $("#adsSectionDiv").load("getAdsSection");                   
                loader.hidePleaseWait(); 
            }
        }); 
        $(form).submit();        
    }    


    function changeSellerBanner(form, url)
    {
        $(form).ajaxForm({

            url: url,
            type: 'GET', 
            dataType: 'jsonp',
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
        $(form).submit();        
    }

    function setPositionAdsSection(url,data)
    {
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#adsSectionDiv").load("getAdsSection");      
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $("#adsSectionDiv").load("getAdsSection");     
                loader.hidePleaseWait();                   
            }
        }); 
    }

    function setPositionProductPanel(url,data)
    {
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $("#productPanelDiv").load("getProductPanel");    
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $("#productPanelDiv").load("getProductPanel");    
                loader.hidePleaseWait();                   
            }
        }); 
    }  


    function addSubSlider(mainSlideForm, url, tableSelector, reloadurl)
    {
        $(mainSlideForm).ajaxForm({

            url: url,
            type: 'GET', 
            dataType: 'jsonp',
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                $(tableSelector).load(reloadurl);              
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $(tableSelector).load(reloadurl);             
                loader.hidePleaseWait();   
            }
        }); 
        $(mainSlideForm).submit();        
    }

    function updateDateContainer(index, subIndex, value, url)
    {

        $("#value_" + index + "_" + subIndex).html(value);
        var obj = '{"url":"' + url +
            '","index":"' +  index +
            '","subIndex":"' + subIndex +
            '","value":"' +value +'"}';

        $("#data_"+ index + "_" + subIndex).attr('data', obj);        
    }

    function appendDataContainer(index, newSubIndex, subIndex, categoryName, url, removeCategoryLink, editCategoryLink)
    {
        var obj = '{"url":"' + editCategoryLink +
            '","index":"' +  index +
            '","subIndex":"' + newSubIndex +
            '","value":"' +categoryName +'"}'; 

        var valueData = "value_"+index+"_"+newSubIndex;                     
        var rowData = "row_"+index+"_"+newSubIndex;                     

        var dataToAppend = '<tr id="'+rowData+'"><td><div class="btn-toolbar" role="toolbar"><button type="button" class="btn btn-danger edit_btn" id="'+"data_"+index+"_"+subIndex+'"'+
                                                    'data="" data-toggle="modal" data-target="#myModal"><span class="glyphicon-center glyphicon glyphicon-cog"></span</button>'+
'<button type="button" class="btn edit_btn removeButton" id="'+"data_"+index+"_"+subIndex+'" data="" ><span class="glyphicon-center glyphicon glyphicon-remove"></span</button>'
                                                    +'</div></td>'+
                '<td id="'+valueData+'">'+categoryName+'</td></tr>';

        $("#subcategories_"+index+" tr").last().after(dataToAppend);
        $("#data_"+ index + "_" + subIndex +".edit_btn").attr("data",obj);
    }

    function showErrorModal(messages) {
            loader.hidePleaseWait();
            $("#errorTexts").html(messages); 
            $("#customerror").modal('show');  
    }                                            

})(jQuery);    
