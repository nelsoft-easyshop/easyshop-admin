(function () {
    var userid = $("#userid").val();
    var password = $("#password").val();
    var newHomeCmsLink = $("#newHomeCmsLink").text();

    var minimumCategoryProductPanel = 2;
    var minimumCategorySectionProductPanel = 3;
    $("#myTabContent").on('click','#addSubCategorySection',function (e) { 
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val();
        var subCategoryText = $(this).closest("form").find("#subCategoryText").val();
        var subCategorySectionTarget = $(this).closest("form").find("#subCategorySectionTarget").val();
        var url = $(this).data('url');
        var hash =  hex_sha1(index + subCategoryText + subCategorySectionTarget + userid + password);
        data = { index: index, subCategoryText:subCategoryText, subCategorySectionTarget:subCategorySectionTarget, userid:userid,  password:password, hash:hash, callback:'?'};

        var tableSelector = "#subCategoriesSection_" + index;
        var reloadurl = "getSubCategoriesSection/" + index;

        if(subCategoryText.trim() == "" || subCategorySectionTarget.trim() == "") {
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

    $("#myTabContent").on('click','.editCategorySection',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);

        $("#edit_categoryText_index").val(data.categorySectionIndex);
        $("#edit_categoryText_subIndex").val(data.subCategorySectionIndex);
        $("#edit_categoryText_url").val(data.url);
        $("#edit_categoryText").val(data.value);
        $("#edit_categoryTarget").val(data.target);

    });  

    $("#modalForCategorySection").on('click','#setSubCategoriesSectionBtn',function (e) { 
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

    $("#myTabContent").on('click','#editCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
        var value = $(this).closest("form").find("#value").val().toString();
        var index = $(this).closest("form").find("#index").val().toString();
        var subindex = $(this).closest("form").find("#subindex").val().toString();
        var url = $(this).data("url");

        var hash =  hex_sha1(index + value + subindex + userid + password);
        data = { index: index, value:value, subindex:subindex, userid:userid, password:password, hash:hash, callback:'?'};

        var tableSelector = "#categorySectionProductPanel_" + index;
        var reloadurl = "getCategoriesProductPanel/" + index;

        if(value.trim() == "") {
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
                    if(json.sites[0]["success"] != "success") {
                        loader.hidePleaseWait();    
                        showErrorModal("Slug Does Not Exist");
                    }   
                    else {
                        $(tableSelector).load(reloadurl);
                        loader.hidePleaseWait();  
                    }                 

                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            });  
        }
    
    });     

    $("#myTabContent").on('click','#moveupCategoryProductPanel, #movedownCategoryProductPanel',function (e) { 
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

    $("#myTabContent").on('click','#removeCategoryProductPanel',function (e) { 
        var index = $(this).data("index").toString();
        var subindex = $(this).data("subindex").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");
        var hash = hex_sha1(index + subindex  + nodename + userid + password);
        data = { index: index, subIndex:subindex,nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};  
        var count = parseInt($(".categoryProductPanelCount_"+index).last().text());        
        var tableSelector = "#categorySectionProductPanel_" + index;
        var reloadurl = "getCategoriesProductPanel/" + index;
        if(count > minimumCategoryProductPanel ) {
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


    $("#manageSliderSection").on('click','#moveup, #movedown',function (e) { 
       
        var action = $(this).data('action').toString();
        var subindex = $(this).data('subindex').toString();
        var index = $(this).data('index').toString();
        var order = parseInt($(this).data('order'));
        var url = $(this).data('url').toString();
        var count = parseInt($(".slideCount_" + index).last().text());
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
        var flag = parseInt(index) + 1;

        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;        
        order = order.toString();
        var hash =  hex_sha1(index + subindex  + order + userid + password);        
        data = { index: index, subIndex:subindex, order:order, userid:userid,  password:password, hash:hash, callback:'?'};

        loader.showPleaseWait();   
        setSliderPosition(url,data, tableSelector, reloadurl);

    
    }); 

    $("#manageSliderSection").on('click','#moveParentSlider',function (e) { 
        var flag = 0;      
        var action = $(this).data('action').toString();
        var index = parseInt($(this).data('index').toString());
        var nodename = $(this).data('nodename').toString();
        var order = index;
        var url = $(this).data('url').toString();
        var count = parseInt($(".parentSliderCount").last().text());
        if(action == "down") {
            if(index + 1 != count) {
                if(order == (count - 1)) {
                    order = order;
                } else {
                     order = order + 1;
                } 
                flag = 1;    
            }
          
        }
        else {
            if(index != 0) {
                if(order > 0) {
                    order = order - 1;
                } else {
                   order = 0;
                }    
                flag = 1;                  
            }
        }
        if(flag == 1) {
            loader.showPleaseWait();             
            order = order.toString();
            var hash =  hex_sha1(action + nodename + index  + order + userid + password);        
            data = { action:action, nodename:nodename, index: index, order:order, userid:userid,  password:password, hash:hash, callback:'?'};
            setPositionParentSlider(url,data);       
        }

    
    });

    $("#manageCategorySection").on('click','#addCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
        var value = $(this).closest("form").find("#value").val().toString();
        var index = $(this).data("index");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + value  + userid + password);
        data = { index: index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};

        var tableSelector = "#categorySectionProductPanel_" + index;
        var reloadurl = "getCategoriesProductPanel/" + index;
        if(value.trim() == "") {
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
                    if(json.sites[0]["success"] != "success") {
                        loader.hidePleaseWait();    
                        showErrorModal("Slug Does Not Exist");
                    }
                    else {
                        loader.hidePleaseWait();  
                        $(tableSelector).load(reloadurl);
                    }

                },
                error: function(e) {
                    loader.hidePleaseWait();
                    showErrorModal("Please try again");
                }
            }); 
        }      
    });  

    $(".subCategoriesSectionTable").on('click','.removeCategorySection',function (e) { 
        var index = $(this).data("index").toString();
        var subIndex = $(this).data("subindex").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + subIndex + nodename + userid + password);
        data = { index: index, subIndex:subIndex, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};

        var tableSelector = "#subCategoriesSection_" + index;
        var reloadurl = "getSubCategoriesSection/" + index;
        var categoryCount = ".subCategorySectionCount_"+index;
        var count = $(categoryCount).last().text();
        if(count >= minimumCategoryProductPanel) {
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
        else {
            showErrorModal("Sorry, but you have reached the minimum number of sub category section");

        }
    });  



    $("#myTabContent").on('click','#setMainNavigation',function (e) { 
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



    $("#previewImage").on('click','#editAdsSection',function (e) { 

        loader.showPleaseWait();
        var index = $(this).closest("form").find("#editAdsIndex").val().toString();
        var url = newHomeCmsLink + "/setAdsSection";
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();     
        var target = $(this).closest("form").find("#target").val().toString();
        if(target.trim() === "") {
            target = "/";
            $(this).closest("form").find("#target").val("/");            
        }
        var hash =  hex_sha1(index + userid + value + target  + password);
        var form = "#cropForm";
        $(this).closest("form").find("#editAdsSectionHash").val(hash);
        editAdsSectionForm(form, url);

    }); 



    $("#previewImage").on('click','#editSubSlider',function (e) { 

        var index = $(this).closest("form").find("#editModalSliderIndex").val().toString();
        var subIndex = $(this).closest("form").find("#editModalSliderSubIndex").val().toString();
        var url = newHomeCmsLink + "/editSubSlider";;
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();     
        var target = $(this).closest("form").find("#target").val().toString();
        target = target == "" ? "/" : target;
        var hash =  hex_sha1(index + subIndex + userid + value + target  + password);
        $(this).closest("form").find("#editHashMainSlide").val(hash);

        var editSlideForm_ = "#cropForm";

        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;

        editSubSlider(editSlideForm_, url, tableSelector, reloadurl);

    }); 



    $("#previewImage").on('click', '#addAdSection',function (e) { 
        
        loader.showPleaseWait();     

        var url = newHomeCmsLink + "/addAdds";
        var target = $(this).closest("form").find("#target").val().toString();
        var userid = $(this).closest("form").find("#userid").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();   
        var password = $(this).closest("form").find("#password").val().toString();
        var hash =  hex_sha1(value + target + userid + password);        
        $(this).closest("form").find("#hashAddAds").val(hash);
        var form = "#cropForm";
        if(value == "") {
            showErrorModal("Please upload na image");
        }
        else {
            loader.showPleaseWait();                 
            addAds(form, url);
        }
    }); 

    $("#manageSellerSection").on('click','#changeSellerBannerSubmit, #changeSellerLogoSubmit, #changeSellerSlug',function (e) { 
        
        loader.showPleaseWait();     
        var url = $(this).data('url');
        var action = $(this).closest("form").find("#action").val().toString();
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        if(action == "slug") {
            var slug = $(this).closest("form").find("#slug").val().toString();
            if(slug.trim() == "") {
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
                        if(json.sites[0]["usererror"]){
                            showErrorModal(json.sites[0]["usererror"]);
                        }   
                    },
                    error: function(e) {
                        loader.hidePleaseWait();
                    }
                });    
            }
        }
        else {

            var value = $(this).closest("form").find("#sellerFile").val().toString();     
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


    $("#productPanelDiv").on('click','#editProductPanel',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $(this).closest("form").find("#value").val();   
        var index = $(this).closest("form").find("#index").val();   
        var hash =  hex_sha1(index  + value + userid + password);
        data = { index: index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        if(value.trim() == "") {
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
                    if(json.sites[0]["success"] != "success") {
                        loader.hidePleaseWait();    
                        showErrorModal("Slug Does Not Exist");
                    }     
                    else {
                        $("#productPanelDiv").load("getProductPanel");                         
                        loader.hidePleaseWait();   
                    }               

                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });
        }
    }); 

    $("#manageSellerSection").on('click','#addProductPanel',function (e) { 
        
        loader.showPleaseWait();          
        var value = $(this).closest("form").find("#value").val();
        var url = $(this).data('url');
        var hash =  hex_sha1( userid + value + password);
        data = { userid:userid, value:value,  password:password, hash:hash, callback:'?'};

        if(value.trim() == "") {
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
                    if(json.sites[0]["success"] != "success") {
                        loader.hidePleaseWait();    
                        showErrorModal("Slug Does Not Exist");
                    }
                    else {
                        $("#productPanelDiv").load("getProductPanel");                     
                        loader.hidePleaseWait();    
                    }
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });  
        }
    });  


    $("#adsSectionDiv").on('click','#removeAdsSection',function (e) { 
            
        var index = $(this).data("index");
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index  + nodename + userid + password);

        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};  
        var count = parseInt($(".adsCount").last().text());
        if(count > 3) {
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

    $("#previewImage").on('click','#addSubSlider',function (e) { 
        loader.showPleaseWait();          
        var image_x = $(this).closest("form").find("#image_x").val().toString();
        var image_y = $(this).closest("form").find("#image_y").val().toString();
        var image_w = $(this).closest("form").find("#image_w").val().toString();
        var image_h = $(this).closest("form").find("#image_h").val().toString();
        var index = $(this).closest("form").find("#modalSliderIndex").val().toString();
        var url = $(this).data('url');
        var userid = $(this).closest("form").find("#userid").val().toString();
        var password = $(this).closest("form").find("#password").val().toString();
        var value = $(this).closest("form").find("#photoFile").val().toString();     
        var target = $(this).closest("form").find("#target").val().toString();

        var count = parseInt($(".subSlide_"+index).last().text());

        if(target.trim() === "") {
            target = "/";
            $("#target").val("/");            
        }
        var hash =  hex_sha1(image_x + image_y + image_w + image_h + value +index + userid + target  + password);

        $(this).closest("form").find("#hashMainSlide").val(hash);
        var mainSlideForm = "#cropForm";

        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;
        if(value == "") {
            $("#previewImage").modal("hide");
            showErrorModal("Please upload na Image")
        }
        else {
            addSubSlider(mainSlideForm, url, tableSelector, reloadurl, count, index);
        }

    });  

    $("#manageSliderSection").on('click','#addMainSlider',function (e) { 
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
                getSliderPreview();
                loader.hidePleaseWait();   
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });        


    });  
    $("#myTabContent").on('click','.removeButton',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        var index = data.index.toString();
        var subIndex = data.subIndex.toString();
        var url = data.url;
        var nodename = "categorySubSlug";
        var hash =  hex_sha1(index + subIndex + nodename + userid + password);
        data = { index: index, subIndex:subIndex, nodename:nodename,userid:userid,  password:password, hash:hash, callback:'?'};  
        var subcategories = "#tblSubcategories_" + index;
        var count = $(subcategories + " tbody tr").length;
        var editCategoryLink = $("#editCategoryLink").val();
        var removeCategoryLink = $("#removeCategoryLink").val();

        var tableSelector = "#tblSubcategories_" + index;
        var reloadurl = "getSubCategoryNavigation/" + index;

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
                    $(tableSelector).load(reloadurl);                  
                    loader.hidePleaseWait();                 
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }        
    }); 


    $("#manageSellerSection").on('click','#removeProductPanel',function (e) { 
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

    $("#manageSliderSection").on('click','#removeSubSlide',function (e) { 
        var index = $(this).data("index").toString();
        var subIndex = $(this).data("subindex").toString();
        var nodename = $(this).data("nodename").toString();
        var url = $(this).data("url");
        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;
        var hash =  hex_sha1(index + subIndex + nodename + userid + password);
        
        var currentSliderTemplate = $("#sliderTemplate" + index).val();

        data = { index: index, subIndex:subIndex, nodename:nodename,userid:userid,  password:password, hash:hash, callback:'?'};  
        var count = parseInt($(".slideCount_" + index).last().text());
        var sliderConstant = $("#template_" + currentSliderTemplate).data("count");
        if(count > sliderConstant ) {
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
                    getSliderPreview();
                    loader.hidePleaseWait();
                       
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    getSliderPreview();                    
                    showErrorModal("Please try again");
                }
            });  
        }      
        else {
            showErrorModal("Sorry, but you have reached the minimum number of images for this slider template")
        }  
    });  

    $("#addBrandsTable").on('click','.editBrands',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);   
        $("#editBrandsUrl").val(data.url);
        $("#editBrandsIndex").val(data.index);
        $('#editBrandsDropDown option[value="'+ data.id_brand +'"]').attr("selected", "selected");
    });  

    $("#manageTopSellers").on('click','#editTopSellersBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);   
        $("#editTopSellersUrl").val(data.url);
        $("#editTopSellersIndex").val(data.index);
        $('#editTopSellersValue').val(data.value);
    });  


    $("#myTabContent").on('click','.btn-danger',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#edit_url").val(data.url);
        $("#edit_index").val(data.index);
        $("#edit_subIndex").val(data.subIndex);
        $('#drop_actionTypeEdit option[value="'+ data.value +'"]').attr("selected", "selected");
    });  

    $("#myTabContent").on('click','#removeCategorySection, #removeMainSlider',function (e) { 
         
        var url = $(this).data("url");
        var nodename = $(this).data("nodename");
        var index = $(this).data("index").toString();
        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index:index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};
        if(nodename == "categorySectionPanel") {
            var count = parseInt($(".categorySectionCount").last().text());
        }
        else {
            var count = parseInt($(".parentSliderCount").last().text());
        }
        if(count > 0) {
            var $confirm = confirm("Are you sure you want to remove?");   
            if($confirm) {
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
                        if(nodename == "categorySectionPanel") {
                            $("#manageCategorySection").load("getCategoriesPanel");
                        }
                        else {
                            $("#manageSliderSection").load("getAllSliders");
                            getSliderPreview();                 

                        }
                    },
                    error: function(e) {
                        getSliderPreview();                                         
                        loader.hidePleaseWait();
                    }
                });             
            }            
        }
        else {
            showErrorModal("Sorry, but you have reached the minimum number of sub category section");            
        }
    }); 

    $("#manageCategorySection").on('click','#addCategorySectionProductPanel',function (e) { 
        var value = $('#addCategorySectionValue option:selected').val();
        var url = $(this).data("url");
        var hash =  hex_sha1(value + userid + password);
        data = { value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        
        var count = parseInt($(".categorySectionCount").last().text());
        if(count < minimumCategorySectionProductPanel) {
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
                    $("#manageCategorySection").load("getCategoriesPanel");
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }
        else {
            showErrorModal("Sorry, but you have reached the maximum number of category section")
        }
  
    });   

    $("#manageNewArrivals").on('click','.removeNewArrival',function (e) { 
     
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


    $("#manageTopSellers").on('click','#addTopSellers',function (e) { 
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
                if(json.sites[0]["usererror"]){
                    showErrorModal(json.sites[0]["usererror"]);
                }
                else {
                    $("#addTopSellersTable").load("getTopSellers");
                }         
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
    }); 

    $("#manageBrands").on('click','.removeBrands',function (e) { 
     
        var index = $(this).data("index").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index: index, nodename:nodename, userid:userid,  password:password, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".brandsCount").last().text());
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
                    $("#addBrandsTable").load("getBrandsSection");
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
        }     
    }); 

    $("#manageBrands").on('click','#addBrandsBtn',function (e) { 
        loader.showPleaseWait();           
        var value = $('#addBrandsDropDown option:selected').val();
        var hash =  hex_sha1(value + userid + password);
        data = {value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        var url = $(this).data("url");
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
                $("#addBrandsTable").load("getBrandsSection");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });           

    });    

    $("#manageTopProducts").on('click','#addTopProducts',function (e) { 
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
                if(json.sites[0]["success"] != "success") {
                    loader.hidePleaseWait();    
                    showErrorModal("Slug Does Not Exist");
                }            
                else {
                    $("#addTopProductsTable").load("getTopProducts");
                }       
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
    });   
    $("#manageTopProducts").on('click','.removeTopProducts',function (e) { 
     
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

    $("#manageTopSellers").on('click','.removeTopSellers',function (e) { 
     
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

    $("#manageNewArrivals").on('click','#addNewArrival',function (e) { 
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


    $("#navigation_others").on('click','#addOtherCategory',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $('#drop_otherCategories option:selected').val();      
        var hash =  hex_sha1(value + userid + password);
        data = {value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        
        var flag = 0;
        var count = parseInt($(".otherCategoriesCount").last().text());
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

    $("#editOtherCategory").on('click','#editOtherCategorySubmit',function (e) { 
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

    $("#editBrandsModal").on('click','#editBrandsSubmit',function (e) { 
        loader.showPleaseWait();           
        var index = $(this).closest("form").find("#editBrandsIndex").val();
        var url = $(this).closest("form").find("#editBrandsUrl").val();
        var value = $(this).closest("form").find("#editBrandsDropDown").val();     
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
                $("#addBrandsTable").load("getBrandsSection");
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
        
    }); 


    $("#editTopSellers").on('click','#editTopSellersSubmit',function (e) { 
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
                if(json.sites[0]["usererror"]){
                    showErrorModal(json.sites[0]["usererror"]);
                }
                else {
                    $("#addTopSellersTable").load("getTopSellers");
                }                
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
        
    }); 

    $("#editTopProducts").on('click','#editTopProductsSubmit',function (e) { 
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
                if(json.sites[0]["success"] != "success") {
                    loader.hidePleaseWait();    
                    showErrorModal("Slug Does Not Exist");
                } 
                else {
                    $("#addTopProductsTable").load("getTopProducts");
                }                  
            },
            error: function(e) {
                loader.hidePleaseWait();
            }
        });          
        
    }); 

    $("#editNewArrival").on('click','#editNewArrivalSubmit',function (e) { 
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
    $("#addBrandsTable").on('click','#editTopSellersBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#editTopSellersValue").val(data.value);
        $("#editTopSellersIndex").val(data.index);
        $("#editTopSellersUrl").val(data.url);

    });  

    $("#addTopProductsTable").on('click','#editTopProductsBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#editTopProductsValue").val(data.value);
        $("#editTopProductsIndex").val(data.index);
        $("#editTopProductsUrl").val(data.url);

    });  

    $("#newArrivalsTable").on('click','#editNewArrivalBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $("#editNewArrivalValue").val(data.value);
        $("#editNewArrivalTarget").val(data.target);
        $("#editNewArrivalIndex").val(data.index);
        $("#editNewArrivalUrl").val(data.url);

    });  

    $("#otherCategoriesTable").on('click','#editOtherCategoryBtn',function (e) { 
        var dataNode = $(this).attr("data");
        var data = $.parseJSON(dataNode);
        $('#drop_otherCategories_edit option[value="'+ data.value +'"]').attr("selected", "selected");
        $("#editOtherIndex").val(data.index);
        $("#editOtherUrl").val(data.url);

    });     

    $("#otherCategoriesTable").on('click','.removeOtherCategory',function (e) { 
     
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

    $("#myModal").on('click','#mdl_save',function (e) { 
        loader.showPleaseWait();           
        var url = $("#edit_url").val();
        var index = $("#edit_index").val().toString();
        var subIndex = $("#edit_subIndex").val().toString();
        var value = $('#drop_actionTypeEdit option:selected').val();      
        var hash =  hex_sha1(index + subIndex + value + userid + password);
        data = { index: index, subIndex:subIndex, value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        var tableSelector = "#tblSubcategories_" + index;
        var reloadurl = "getSubCategoryNavigation/" + index;
        var flag = 0;

        $("#tblSubcategories_" + index + " tbody tr").each(function(){
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
                    $(tableSelector).load(reloadurl);         
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

    $("#myTabContent").on('click','#setSliderDesignTemplate',function (e) { 
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val();
        var value = $(this).closest("form").find("#drop_actionType option:selected").val();
        var imageCount = $(this).closest("form").find("#drop_actionType option:selected").data('count');
        var url = $(this).data("url");
        var hash = hex_sha1(index + value + userid + password);
        data = { index: index, value:value, userid:userid,  password:password, hash:hash, callback:'?'};
        var count = parseInt($(".slideCount_" + index).last().text());
        var currentSliderTemplate = $("#sliderTemplate" + index).val();

        if(count >= imageCount ) {
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
                    $("#sliderTemplate" + index).val(value);                                   
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });           
        }
        else {
            $(this).closest("form").find('#drop_actionType option[value="'+ currentSliderTemplate +'"]').attr("selected", "selected");
            showErrorModal("Sorry, but the minimum number of images for this slide design template is " + imageCount + " images");
        }
 
   
    });  

    $("#manageSliderSection").on('click','#commitSliderChanges',function (e) { 
        loader.showPleaseWait();
        var commit = 1;
        var hash = hex_sha1(userid + password);
        $.ajax({
            type: 'post',
            data: {hash:hash, commit:commit},
            url: "getSliderPreview",
            dataType: 'json',
            success: function(json) {
                $("#sliderPreview").html(json.html);  
                loader.hidePleaseWait();
                   
            },
        });   
    }); 

    $("#manageSliderSection").on('click','#discardChanges',function (e) { 
        var url = $(this).data("url");
        loader.showPleaseWait();
        var hash = hex_sha1(userid + password);
        $.ajax({
            type: 'GET',
            url: url,
            data:{hash:hash, userid:userid},
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
                showErrorModal("Please try again");
            }            
        });   
    });     

    $("#myTabContent").on('click','#addSubCategoryNavigation',function (e) { 
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

        var tableSelector = "#tblSubcategories_" + index;
        var reloadurl = "getSubCategoryNavigation/" + index;

        $("#tblSubcategories_" + " tbody tr").each(function(){
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
                        $(tableSelector).load(reloadurl);                  
                        loader.hidePleaseWait();  

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


    function setSliderPosition(url,data, tableSelector, reloadurl)
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
                $(tableSelector).load(reloadurl);   
                loader.hidePleaseWait();                   
            }
        });
        getSliderPreview();            
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
                getSliderPreview();                              
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $(tableSelector).load(reloadurl); 
                getSliderPreview();                            
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

    function setPositionParentSlider(url, data)
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

                $("#previewImage").modal("hide");                      
                $(tableSelector).load(reloadurl);              
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $("#previewImage").modal("hide");               
                $(tableSelector).load(reloadurl);             
                loader.hidePleaseWait();   

            }
        }); 

    }    

    function getSliderPreview()
    {
        var commit = 0;
        var hash = hex_sha1(userid + password);
        $.ajax({
            type: 'post',
            data: {hash:hash, commit:commit},
            url: "getSliderPreview",
            dataType: 'json',
            success: function(json) {
                $("#sliderPreview").html(json.html);  
                loader.hidePleaseWait();
                   
            },
        });         
    }


    function addSubSlider(mainSlideForm, url, tableSelector, reloadurl, count, index)
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
                getSliderPreview();                           
                loader.hidePleaseWait();   
            },
            error: function(e) {
                $(tableSelector).load(reloadurl);   
                getSliderPreview();                          
                loader.hidePleaseWait();   
            }
        }); 
        $(mainSlideForm).submit();        
    }    

    function showErrorModal(messages) {
            loader.hidePleaseWait();
            $("#errorTexts").html(messages); 
            $("#customerror").modal('show');  
    }      

    $("#myTabContent").on('click','#addSliderCrop,#editSubSliderCrop,#addAdsCrop,#editAdsCrop',function (e) { 

        $('.cropFormButton').prop('disabled', true);
        var nodename = $(this).data("nodename");
        if(nodename == "addMainSlider") {
            var clone = $("#cloneForm_addSubSlider").html();
            $("#contentPreview").html(clone);
            $("#contentPreview").find("#modalSliderIndex").val($(this).data("index"));
            var actionLink = newHomeCmsLink + "/addSubSlider";
            $(".cropFormButton").attr("data-url",actionLink);
            $(".cropFormButton").attr("id","addSubSlider");
            $("#previewImage").find("form").attr("action",actionLink);       
            $("#previewImage").find("#displayFormGroup").css("display","block");

        }
        else if(nodename == "editMainSlider" ) {
            var index = $(this).data("index");
            var subindex = $(this).data("subindex");
            var clone = $("#editSlideForm_"+index+"_"+subindex).html();
            $("#contentPreview").find("#editModalSliderIndex").val(index);
            $("#contentPreview").find("#editModalSliderSubIndex").val(subindex);
            $("#contentPreview").html(clone); 
            var actionLink = newHomeCmsLink + "/editSubSlider";
            $(".cropFormButton").attr("id","editSubSlider");            
            $(".cropFormButton").attr("data-url",actionLink);            
            $("#previewImage").find("form").attr("action",actionLink);
            $("#previewImage").find("#displayFormGroup").css("display","block");

        }
        else if(nodename == "addAds") {
            var clone = $("#cloneForm_addAds").html();
            $("#contentPreview").html(clone);
            var actionLink = newHomeCmsLink + "/addAdds";
            $(".cropFormButton").attr("id","addAdSection");            
            $(".cropFormButton").attr("data-url",actionLink);             
            $("#previewImage").find("form").attr("action",actionLink);    
            $("#previewImage").find("#displayFormGroup").css("display","block");

        }
        else if(nodename == "editAds"){

            var index = $(this).data("index"); 
            var clone = $("#clone_editAdsCrop_"+index).html();                      
            $("#contentPreview").find("#editAdsIndex").val(index);
            $("#contentPreview").html(clone); 
            var actionLink = newHomeCmsLink + "/setAdsSection";
            $(".cropFormButton").attr("id","editAdsSection");            
            $(".cropFormButton").attr("data-url",actionLink);            
            $("#previewImage").find("form").attr("action",actionLink);
            $("#previewImage").find("#displayFormGroup").css("display","block");  
        }

    });

    /*********************** JCROP ******************************/
    $("#photoFile").on("change", function(){
        var jcrop;
        var currValue  = $(this).val();
        var oldIE;
        var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
        
        if ($('html').is('.ie6, .ie7, .ie8, .ie9')){
            oldIE = true;
        }

        if (oldIE || isSafari){
            $('#form_image').submit();
        }
        else{

            $("#scaleAndCrop").css("display","block");
            imageprev(this);
        }
    });   


    $(' #previewImage').bind('hidden.bs.modal', function () {
        $("#contentPreview").find("#photoFile").val("");
        jcrop_api = $.Jcrop($('#user_image_prev'));  
        resetCoords();        
        jcrop_api.destroy();         
        $("#scaleAndCrop").css("display","none");        
    });  

    /***************    Image preview for cropping  ************************/
function imageprev(input) {

    var jcrop_api, width, height;
    
    if (input.files && input.files[0] && input.files[0].type.match(/(gif|png|jpeg|jpg)/g) && input.files[0].size <= 5000000) {
        var reader = new FileReader();

        reader.onload = function(e){
            var image = new Image();
            image.src = e.target.result;
            image.onload = function(){
                width = this.width;
                height = this.height;

                $('#user_image_prev').attr('src', this.src);
                if(width >10 && height > 10 && width <= 5000 && height <= 5000) {

                    jcrop_api = $.Jcrop($('#user_image_prev'),{
                        boxWidth: 500,
                        boxHeight: 500,
                        minSize: [width*0.1,height*0.1],
                        setSelect:[0,0,width*0.5,height*0.5],
                        trueSize: [width,height],
                        onChange: showCoords,
                        onSelect: showCoords,
                        onRelease: resetCoords
                    });    
   

                    $(' #previewImage').bind('hidden.bs.modal', function () {

                        $('#user_image_prev').attr('src', '');
                        resetCoords();
                        jcrop_api.destroy(); 
                        var img = $('<img id="user_image_prev">');
                        img.attr('src', "");
                        img.appendTo("#imgContainer");
                    });                                        
                  

                }
                else if(width > 5000 || height > 5000) {
                    showErrorModal("Failed to upload image. Max image dimensions: 5000px x 5000px");
                }                    
                else {
                    $('#div_user_image_prev span:first').html('Preview');
                }                    
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
    else {
        showErrorModal("You can only upload gif|png|jpeg|jpg files at a max size of 5MB!");
    }

    
}

function showCoords(c){
    $('.cropFormButton').prop('disabled', false);    
    $('#image_x').val(c.x);
    $('#image_y').val(c.y);
    $('#image_w').val(c.w);
    $('#image_h').val(c.h);
}

function resetCoords(){
    $('#image_x').val(0);
    $('#image_y').val(0);
    $('#image_w').val(0);
    $('#image_h').val(0);
}
                                   

})(jQuery);    

