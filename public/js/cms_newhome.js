(function () {

    var formSubmitted = 0;
    var userid = $("#userid").val();
    var newHomeCmsLink = $("#newHomeCmsLink").text();
    var minimumCategoryProductPanel = 1;
    var minimumCategorySectionProductPanel = 3;

    $(window).on('beforeunload', function(){
        if(formSubmitted === 1) {
            return "Don't you want to save your changes first?";
        }
    });

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
    });    

    $("#myTabContent").on('click','#addSubCategorySection',function (e) { 
        loader.showPleaseWait();          
        var $this = $(this);
        var $form = $this.closest("form");
        var index = $form.find("#index").val();
        var subCategoryText = $form.find("#subCategoryText").val();
        var url = $this.data('url');
        
        var requestData = {
            index:index, 
            subCategoryText:subCategoryText, 
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            requestData.callback = '?';
            
            if(subCategoryText.trim() === "") {
                showErrorModal("Please enter values to the required fields");
            }
            else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
                    jsonpCallback: 'jsonCallback',
                    contentType: "application/json",
                    dataType: 'jsonp',
                    success: function(json) {
                        $( "#manageCategorySection" ).load("getCategoriesPanel", function( response, status, xhr ) {
                            var accordionId = "#collapseAccordion_" + index;
                            $(accordionId).trigger("click");
                            var aTag = $("a[href='#collapse_category_"+ index +"']");
                            $('html,body').animate({scrollTop: aTag.offset().top},'slow');    

                            loader.hidePleaseWait();  
                        });
                    },
                    error: function(e) {
                        loader.hidePleaseWait();
                    }
                });  
            }     

        });

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
        var tableSelector = "#subCategoriesSection_" + index;
        var reloadurl = "getSubCategoriesSection/" + index;
        
        var requestData = {
            index:index, 
            subIndex:subIndex,
            text:text,
            target:target,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            requestData.callback = '?';            
            $.ajax({
                type: 'GET',
                url: url,
                data:requestData,
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

    });      

    $("#myTabContent").on('click','#editCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
        var $this = $(this);
        var $form = $this.closest("form");

        var value = $form.find("#value").val().toString();
        var index = $form.find("#index").val().toString();
        var subindex = $form.find("#subindex").val().toString();
        var subPanelIndex = $form.find("#subPanelIndex").val().toString();
        var newCategorySection = $form.find("#newCategorySection").val().toString();
        var url = $this.data("url");

        if(value.trim() == "") {
            showErrorModal("Please supply a slug");
        }
        else{

            var requestData = {
                index:index, 
                value:value,
                subindex:subindex,
                subPanelIndex:subPanelIndex,
                userid:userid
            };

            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {
                requestData.hash = hash;
                requestData.callback = '?';            

                var tableSelector = "#categorySectionProductPanel_" + index + "_" +subindex;
                var reloadurl = "getCategoriesProductPanel/" + index + "/" + subindex + "/" + newCategorySection;
                
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
            });
        }
    });     

    $("#myTabContent").on('click','#moveupCategoryProductPanel, #movedownCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
        
        var $this = $(this);
        var action = $this.data('action').toString();
        var subindex = $this.data('subindex').toString();
        var index = $this.data('index').toString();
        var subpanelindex = $this.data('subpanelindex').toString();
        var newcategorysection = $this.data('newcategorysection').toString();
        var order = parseInt($this.data('order'));
        var url = $this.data('url').toString();
        var count = parseInt($(".categoryProductPanelCount").last().text());

        var tableSelector = "#categorySectionProductPanel_" + index + "_" +subindex;
        var reloadurl = "getCategoriesProductPanel/" + index + "/" + subindex + "/" + newcategorysection;        
        if(action == "down") {
            if(order == (count - 1)) {
                order = order;
            } 
            else {
                 order = order + 1;
            }           
        }
        else {
            if(order > 0) {
                order = order - 1;
            } 
            else {
               order = 0;
            }    
        }
        order = order.toString();

        var requestData = {
            index:index, 
            subIndex:subindex,
            subpanelindex:subpanelindex,
            order:order,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            requestData.callback = '?';            
            setCategoryProductPosition(url, requestData, tableSelector, reloadurl);    
        });
    }); 

    $("#myTabContent").on('click','#removeCategoryProductPanel',function (e) { 
       
        var $this = $(this);        
        var index = $this.data("index").toString();
        var subindex = $this.data("subindex").toString();
        var subpanelindex = $this.data("subpanelindex").toString();
        var newcategorysection = $this.data("newcategorysection").toString();
        var nodename = $this.data("nodename");
        var url = $this.data("url");
        
        var requestData = {
            index:index, 
            subIndex:subindex,
            subpanelindex:subpanelindex,
            nodename:nodename,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            requestData.callback = '?';            

            var count = parseInt($(".categoryProductPanelCount_"+index+"_"+subindex).last().text());      
            var tableSelector = "#categorySectionProductPanel_" + index + "_" +subindex;
            var reloadurl = "getCategoriesProductPanel/" + index + "/" + subindex + "/" + newcategorysection;
            if(count > minimumCategoryProductPanel ) {
                loader.showPleaseWait();                    
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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

    });  


    $("#manageSliderSection").on('click','#moveup, #movedown',function (e) { 
        var $this = $(this);
        formSubmitted = 1;
        var action = $this.data('action').toString();
        var subindex = $this.data('subindex').toString();
        var index = $this.data('index').toString();
        var order = parseInt($this.data('order'));
        var url = $this.data('url').toString();
        var count = parseInt($(".slideCount_" + index).last().text());
        if(action == "down") {
            if(order == (count - 1)) {
                order = order;
            } 
            else {
                 order = order + 1;
            }           
        }
        else {
            if(order > 0) {
                order = order - 1;
            } 
            else {
               order = 0;
            }    
        }
        var flag = parseInt(index) + 1;

        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;        
        order = order.toString();

        var requestData = {
            index:index, 
            subIndex:subindex,
            order:order,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            requestData.callback = '?';            
            loader.showPleaseWait();   
            setSliderPosition(url, requestData, tableSelector, reloadurl);
        });    
    }); 

    $("#manageSliderSection").on('click','#moveParentSlider',function (e) { 
        var flag = 0;              
        var $this = $(this);
        var action = $this.data('action').toString();
        var index = parseInt($this.data('index').toString());
        var nodename = $this.data('nodename').toString();
        var order = index;
        var url = $this.data('url').toString();
        var count = parseInt($(".parentSliderCount").last().text());
        if(action == "down") {
            if(index + 1 != count) {
                if(order == (count - 1)) {
                    order = order;
                } 
                else {
                     order = order + 1;
                } 
                flag = 1;    
            }
          
        }
        else {
            if(index != 0) {
                if(order > 0) {
                    order = order - 1;
                } 
                else {
                   order = 0;
                }    
                flag = 1;                  
            }
        }
        if(flag == 1) {
            loader.showPleaseWait();             
            order = order.toString();
            
            var requestData = {
                action:action, 
                nodename:nodename,
                index:index,
                order:order,
                userid:userid
            };

            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {
                requestData.hash = hash;
                requestData.callback = '?';            
                setPositionParentSlider(url, requestData, index, action);       
            });    
        }    
    });

    $("#manageCategorySection").on('click','#addCategoryProductPanel',function (e) { 
        loader.showPleaseWait();          
       
        var $this = $(this);
        var value = $this.closest("form").find("#value").val().toString();
        var index = $this.data("index");
        var subindex = $this.data("subindex").toString();
        var subpanelindex = $this.data("subpanelindex").toString();
        var url = $this.data("url");
        
        var tableSelector = "#categorySectionProductPanel_" + index + "_" +subindex;
        var reloadurl = "getCategoriesProductPanel/" + index + "/" +subindex + "/" +subpanelindex;
        if(value.trim() == "") {
            showErrorModal("Please supply a slug");
        }
        else {
            var count = parseInt($(".categoryProductPanelCount_"+index+"_"+subindex).last().text());
            if(count < 10) {
                  
                var requestData = {
                    index:index, 
                    value:value,
                    subindex:subindex,
                    subpanelindex:subpanelindex,
                    userid:userid
                };

                $.ajax({
                    url: "/hasher",
                    data: requestData,
                    dataType:"JSON",
                }).success(function(hash) {
                    requestData.hash = hash;
                    requestData.callback = '?';
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data:requestData,
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
                });
            }
            else {
                showErrorModal("Sorry, but you have reached the maximum number of product");
            }
        }      
    });


    $(".subCategoriesSectionTable").on('click','.removeCategorySection',function (e) {
        var $this = $(this);        
        var index = $this.data("index").toString();
        var subIndex = $this.data("subindex").toString();
        var nodename = $this.data("nodename");
        var url = $this.data("url");
        
        var tableSelector = "#subCategoriesSection_" + index;
        var reloadurl = "getSubCategoriesSection/" + index;
        var categoryCount = ".subCategorySectionCount_"+index;
        var count = $(categoryCount).last().text();
        if(count >= minimumCategoryProductPanel) {
            loader.showPleaseWait();                      
                                   
            var requestData = {
                index:index, 
                subIndex:subIndex,
                nodename:nodename,
                userid:userid
            };

            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {
                requestData.hash = hash;
                requestData.callback = '?';
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
        }
        else {
            showErrorModal("Sorry, but you have reached the minimum number of sub category section");

        }
    });  



    $("#myTabContent").on('click','#setMainNavigation',function (e) { 
        loader.showPleaseWait();          

        var $this = $(this);
        var $form = $this.closest("form");
      
        var index = $form.find("#index").val();
        var categoryName = $form.find("#drop_actionType").val();
        var catName = $form.find("#drop_actionType option:selected").data("catname");    
        var url = $this.data('url');
        var prev = $this.data('prev');
        var count = $('.mainNavigation_'+categoryName).length;

        if(count > 0) {
            loader.hidePleaseWait();
            showErrorModal("Main category already exists");
        }
        else {
                                   
            var requestData = {
                index:index, 
                value:categoryName,
                userid:userid
            };

            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {
                requestData.hash = hash;
                requestData.callback = '?';
                $form.closest("div").attr("id","navigation_" + categoryName); 
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
                    jsonpCallback: 'jsonCallback',
                    contentType: "application/json",
                    dataType: 'jsonp',
                    success: function(json) {
                        loader.hidePleaseWait();   
                        $("#mainNavigation_"+index).html(catName);
                        $("#mainNavigation_"+index).attr("href","#navigation_" + categoryName);
                    },
                    error: function(e) {
                        loader.hidePleaseWait();
                    }
                });                        
            });
        }
    });  
    
    $("#previewImage").on('click','#editAdsSection',function (e) { 

        loader.showPleaseWait();
        var $this = $(this);
        var $form = $this.closest("form");

        var image_x = $form.find("#image_x").val().toString();
        var image_y = $form.find("#image_y").val().toString();
        var image_w = $form.find("#image_w").val().toString();
        var image_h = $form.find("#image_h").val().toString();

        var index = $form.find("#editAdsIndex").val().toString();
        var url = newHomeCmsLink + "/setAdsSection";
        var userid = $form.find("#userid").val().toString();
        var value = $form.find("#photoFile").val().toString();     
        var target = $form.find("#target").val().toString();
        if(target.trim() === "") {
            target = "/";
            $form.find("#target").val("/");            
        }

        var requestData = {
            image_x:image_x, 
            image_y:image_y,
            image_w:image_w,
            image_h:image_h,
            value:value,
            index:index,
            userid:userid,
            target:target
        };
        
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {            
            var cropFormSelector = "#cropForm";
            $form.find("#editAdsSectionHash").val(hash);
            editAdsSectionForm(cropFormSelector, url);
        });

    }); 

    $("#previewImage").on('click','#editSubSlider',function (e) { 
        formSubmitted = 1;
        var $this = $(this);
        var $form = $this.closest("form");

        var image_x = $form.find("#image_x").val().toString();
        var image_y = $form.find("#image_y").val().toString();
        var image_w = $form.find("#image_w").val().toString();
        var image_h = $form.find("#image_h").val().toString();

        var index = $form.find("#editModalSliderIndex").val().toString();
        var subIndex = $form.find("#editModalSliderSubIndex").val().toString();
        var url = newHomeCmsLink + "/editSubSlider";;
        var userid = $form.find("#userid").val().toString();
        var value = $form.find("#photoFile").val().toString();     
        var target = $form.find("#target").val().toString();
        target = target == "" ? "/" : target;

        var requestData = {
            image_x:image_x, 
            image_y:image_y,
            image_w:image_w,
            image_h:image_h,
            value:value,
            index:index,
            subIndex: subIndex,
            userid:userid,
            target:target
        };
        
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {                        
            $form.find("#editHashMainSlide").val(hash);
            var editSlideForm_ = "#cropForm";
            var tableSelector = "#sliderReload_" + index;
            var reloadurl = "getSlideSection/" + index;
            editSubSlider(editSlideForm_, url, tableSelector, reloadurl);
        });
    }); 

    $("#previewImage").on('click', '#addAdSection',function (e) { 
        
        loader.showPleaseWait();     

        var $this = $(this);
        var $form = $this.closest("form");

        var image_x = $form.find("#image_x").val().toString();
        var image_y = $form.find("#image_y").val().toString();
        var image_w = $form.find("#image_w").val().toString();
        var image_h = $form.find("#image_h").val().toString();

        var url = newHomeCmsLink + "/addAdSection";
        var target = $form.find("#target").val().toString();
        var userid = $form.find("#userid").val().toString();
        var value = $form.find("#photoFile").val().toString();   

        var requestData = {
            image_x:image_x, 
            image_y:image_y,
            image_w:image_w,
            image_h:image_h,
            value:value,
            target:target,
            userid:userid,
        };
        
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {                                    
            $form.find("#hashAddAds").val(hash);
            var cropFormSelector = "#cropForm";
            if(value == "") {
                showErrorModal("Please upload an image");
            }
            else {
                loader.showPleaseWait();                 
                addAds(cropFormSelector, url);
            }
        });
    }); 
    
    $("#manageSellerSection").on('click','#useDefaultSellerLogoSubmit', function(e) {
        var $this = $(this);
        loader.showPleaseWait();  
        var url = $this.data('url');
        var action = 'deleteLogo';
        var userid = $this.closest("form").find("#userid").val().toString();
        
        var requestData = {
            userid:userid,
            action:action
        };
        
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {                                    
            requestData.hash = hash;
            $.ajax({
                type: 'GET',
                url: url,
                data: requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    loader.hidePleaseWait();
                    $("#setSellerHeadSection").load("getSellerSection");
                },
                complete: function(){
                    loader.hidePleaseWait();
                }
            });    
        });
    });

    $("#manageSellerSection").on('click','#changeSellerBannerSubmit, #changeSellerLogoSubmit, #changeSellerSlug',function (e) { 
        loader.showPleaseWait();     
        var $this = $(this);
        var $form = $this.closest("form");
        var url = $this.data('url');
        var action = $form.find("#action").val().toString();
        var userid = $form.find("#userid").val().toString();

        if(action == "slug") {
            var slug = $form.find("#slug").val().toString();
            if(slug.trim() == "") {
                loader.hidePleaseWait();                  
                showErrorModal("Please enter a valid slug");
            }
            else {                               
                var requestData = {
                    slug: slug,
                    action: action,
                    userid:userid,
                };
                
                $.ajax({
                    url: "/hasher",
                    data: requestData,
                    dataType:"JSON",
                }).success(function(hash) {                                   
                    requestData.hash = hash;
                    requestData.callback = '?';
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data:requestData,
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
                });
            }
        }
        else {
            var value = $form.find("#sellerFile").val().toString();                  
            var requestData = {
                userid:userid,
                value: value,
                action: action
            };
                
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) { 
                var form = "";
                if(action == "banner") {
                    $form.find("#hashChangeSellerBanner").val(hash);
                    var formSelector = "#changeSellerBannerForm";
                }
                else if(action == "logo"){
                    $form.find("#hashChangeSellerLogo").val(hash);
                    var formSelector = "#changeSellerLogoForm";            
                }
                var ext = value.split('.').pop().toLowerCase();
                if(value === "" || ($.inArray(ext, ['gif','png','jpg','jpeg']) === -1)) {
                    showErrorModal("Please upload an image");
                }
                else {
                    changeSellerBanner(formSelector,url);
                }
            });
        }
    }); 


    $("#productPanelDiv").on('click','#editProductPanel',function (e) { 
        loader.showPleaseWait();           
        var $this = $(this);
        var $form = $this.closest("form");
        
        var url = $this.data("url");
        var value = $form.find("#value").val();   
        var index = $form.find("#index").val();   

        if(value.trim() == "") {
            showErrorModal("Please supply a slug");
        }
        else {
            
            var requestData = {
                index:index,
                value: value,
                userid: userid
            };
                
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) { 
                requestData.hash = hash;
                requestData.callback = '?';
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
            });          
        }
    }); 

    $("#manageSellerSection").on('click','#addProductPanel',function (e) { 
        
        loader.showPleaseWait();
        var $this = $(this);
        var $form =  $this.closest("form");
        var value = $form.find("#value").val();
        var url = $this.data('url');

        if(value.trim() == "") {
            showErrorModal("Please supply a valid slug");
        }
        else {
            
            var requestData = {
                userid: userid,
                value: value            
            };
        
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) { 
                requestData.hash = hash;
                requestData.callback = '?';
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
            });      
        }
    });  

    $("#adsSectionDiv").on('click','#removeAdsSection',function (e) { 
        var $this = $(this);            
        var index = $this.data("index");
        var nodename = $this.data("nodename");
        var url = $this.data("url");
        
        var count = parseInt($(".adsCount").last().text());
        if(count > 3) {
            var requestData = {
                index: index,
                nodename: nodename,
                userid: userid
            };
            
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) { 
                requestData.hash = hash;
                requestData.callback = '?';
            loader.showPleaseWait();                    
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
            });
        }

    });

    $("#previewImage").on('click','#addSubSlider',function (e) { 
        var $this = $(this);
        var $form = $this.closest("form");
        formSubmitted = 1;        
        loader.showPleaseWait();          
        var image_x = $form.find("#image_x").val().toString();
        var image_y = $form.find("#image_y").val().toString();
        var image_w = $form.find("#image_w").val().toString();
        var image_h = $form.find("#image_h").val().toString();
        var index = $form.find("#modalSliderIndex").val().toString();
        var url = $this.data('url');
        var userid = $form.find("#userid").val().toString();
        var value = $form.find("#photoFile").val().toString();     
        var target = $form.find("#target").val().toString();
        var template = $("#clonedSliderCountConstant").text();
        var sliderConstant = $("#template_" + template).data("count");
        var count = parseInt($(".subSlide_"+index).last().text());

        if(target.trim() === "") {
            target = "/";
            $("#target").val("/");            
        }

        var requestData = {
            image_x: image_x, 
            image_y: image_y, 
            image_w: image_w, 
            image_h: image_h,
            value: value,
            index: index,
            userid: userid,
            target: target
        };
            
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {             
            $form.find("#hashMainSlide").val(hash);
            var mainSlideForm = "#cropForm";            
            var tableSelector = "#sliderReload_" + index;
            var reloadurl = "getSlideSection/" + index;
            if(value == "") {
                $("#previewImage").modal("hide");
                showErrorModal("Please upload an image")
            }
            else {
                addSubSlider(mainSlideForm, url, tableSelector, reloadurl, count, index);
            }           
        });

    });  

    $("#manageSliderSection").on('click','#addMainSlider',function (e) { 
        formSubmitted = 1;
        loader.showPleaseWait();          
        var $this = $(this);
        var $form = $this.closest("form");
        var template = $form.find("#drop_actionType").val();
        var url = $this.data('url');
        
        var requestData = {
            template:template,
            userid: userid
        };
            
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {             
            requestData.hash = hash;
            requestData.callback = '?';            
            $.ajax({
                type: 'GET',
                url: url,
                data:requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    $( "#manageSliderSection" ).load("getAllSliders", function( response, status, xhr ) {
                        var accordionId = "#collapse_" + (parseInt($(".parentSliderCount").last().text())-1);
                        if ( status !== "error" ) {
                            var aTag = $("a[href='"+ accordionId +"']");
                            $('html,body').animate({scrollTop: aTag.offset().top},'slow');                        
                        }
                        $(accordionId).addClass("in");
                    });                
                    getSliderPreview();
                    loader.hidePleaseWait();   
                    
                },
                error: function(e) {
                showErrorModal("Something went wrong, please try again later");
                    loader.hidePleaseWait();
                }
            });        
        });
    });  


    $("#myTabContent").on('click','.removeButton',function (e) { 
        var $this = $(this);
        var dataNode = $this.attr("data");
        var data = $.parseJSON(dataNode);
        var index = data.index.toString();
        var subIndex = data.subIndex.toString();
        var url = data.url;
        var nodename = "categorySubSlug";
        var subcategories = "#tblSubcategories_" + index;
        var count = $(subcategories + " tbody tr").length;
        var editCategoryLink = $("#editCategoryLink").val();
        var removeCategoryLink = $("#removeCategoryLink").val();

        var tableSelector = "#tblSubcategories_" + index;
        var reloadurl = "getSubCategoryNavigation/" + index;

        if(count > 1 ) {
            
            var requestData = {
                index:index,
                subIndex:subIndex,
                nodename: nodename,                
                userid: userid
            };
            
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {             
                requestData.hash = hash;
                requestData.callback = '?';                
                loader.showPleaseWait();            
                $.ajax({
                type: 'GET',
                    url: url,
                    data:requestData,
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

            });
        }        
    }); 


    $("#manageSellerSection").on('click','#removeProductPanel',function (e) {         
        var $this = $(this);
        var index = $this.data("index");
        var nodename = $this.data("nodename");
        var url = $this.data("url");
        
        var count = parseInt($(".productPanelCount").last().text());
        if(count > 1 ) {
                        
            var requestData = {
                index:index,
                nodename: nodename,                
                userid: userid
            };
            
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {             
                requestData.hash = hash;
                requestData.callback = '?';                
                loader.showPleaseWait();                    
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
            });
        }

    }); 

    $(document.body).on('click','#editSubCategorySection',function (e) { 
        var $this = $(this);
        var $form = $this.closest("form");
        loader.showPleaseWait();
        var index = $this.data("index").toString();
        var url = $this.data("url").toString();
        var subIndex = $this.data("subindex").toString();
        var text = $form.find("#subCategoryText").val().trim();
        var url = $this.data("url");

        if(text !== "") {
            var requestData = {
                index:index,
                subIndex: subIndex,
                value:text,
                userid: userid
            };
            
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {             
                requestData.hash = hash;                
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: requestData,
                    jsonpCallback: 'jsonCallback',
                    contentType: "application/json",
                    dataType: 'jsonp',
                    success: function(json) {
                        $( "#manageCategorySection" ).load("getCategoriesPanel", function( response, status, xhr ) {
                            var accordionId = "#collapseAccordion_" + index;
                            $(accordionId).trigger("click");
                            var aTag = $("a[href='#collapse_category_"+ index +"']");
                            $('html,body').animate({scrollTop: aTag.offset().top},'slow');    
                            loader.hidePleaseWait();  
                        });
                        getSliderPreview();
                        loader.hidePleaseWait();
                        
                    },
                    error: function(e) {
                        loader.hidePleaseWait();
                        getSliderPreview();                    
                        showErrorModal("Please try again");
                    }
                });
            });
        }
        else {
            showErrorModal("Please supply a value");
        }
    });


    $(document.body).on('click','#setCategorySection',function (e) { 
        loader.showPleaseWait();
        var $this = $(this);
        var $form = $this.closest("form");
        var index = $this.data("index").toString();
        var categoryName = $form.find("#setCategorySectionDropDown option:selected").val();        
        var url = $this.data("url");

        var requestData = {
            index:index,
            value: categoryName,
            userid: userid
        };
            
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {             
            requestData.hash = hash;
            $.ajax({
                type: 'GET',
                url: url,
                data: requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    $( "#manageCategorySection" ).load("getCategoriesPanel", function( response, status, xhr ) {
                        var accordionId = "#collapseAccordion_" + index;
                        $(accordionId).trigger("click");
                        var aTag = $("a[href='#collapse_category_"+ index +"']");
                        $('html,body').animate({scrollTop: aTag.offset().top},'slow');    
                        loader.hidePleaseWait();  
                    });
                    getSliderPreview();
                    loader.hidePleaseWait();
                    
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    getSliderPreview();                    
                    showErrorModal("Please try again");
                }
            });        
        });

    });

    $(document.body).on('click','.removeSubCategorySection',function (e) { 
        var $this = $(this);
        loader.showPleaseWait();
        var index = $this.data("index").toString();
        var subindex = $this.data("subindex").toString();
        var nodename = $this.data("nodename");
        var url = $this.data("url");

        var requestData = {
            index:index,
            subindex:subindex,
            nodename:nodename,
            userid:userid
        };
            
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {             
            requestData.hash = hash;
            $.ajax({
                type: 'GET',
                url: url,
                data: requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    $( "#manageCategorySection" ).load("getCategoriesPanel", function( response, status, xhr ) {
                        var accordionId = "#collapseAccordion_" + index;
                        $(accordionId).trigger("click");
                        var aTag = $("a[href='#collapse_category_"+ index +"']");
                        $('html,body').animate({scrollTop: aTag.offset().top},'slow');    
                        loader.hidePleaseWait();  
                    });
                    getSliderPreview();
                    loader.hidePleaseWait();                   
                },
                error: function(e) {
                    loader.hidePleaseWait();
                    getSliderPreview();                    
                    showErrorModal("Please try again");
                }
            });        
        });
    });

    $("#manageSliderSection").on('click','#removeSubSlide',function (e) { 
        formSubmitted = 1;  
        var $this = $(this);
        var index = $this.data("index").toString();
        var subIndex = $this.data("subindex").toString();
        var nodename = $this.data("nodename").toString();
        var url = $this.data("url");
        var tableSelector = "#sliderReload_" + index;
        var reloadurl = "getSlideSection/" + index;
        var currentSliderTemplate = $("#sliderTemplate" + index).val();
        var count = parseInt($(".slideCount_" + index).last().text());
        var sliderConstant = $("#template_" + currentSliderTemplate).data("count");
        
        var requestData = {
            index:index,
            subIndex:subIndex,
            nodename:nodename,
            userid:userid
        };
            
        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {             
            requestData.hash = hash;
            requestData.callback = '?';
            
            if(count > sliderConstant ) {
                loader.showPleaseWait();                    
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
        var $this = $(this);
        var url = $this.data("url");
        var nodename = $this.data("nodename");
        var index = $this.data("index").toString();

        if(nodename == "categorySectionPanel") {
            var count = parseInt($(".categorySectionCount").last().text());
        }
        else {
            var count = parseInt($(".parentSliderCount").last().text());
        }

        if(nodename === "categorySectionPanel" || count > 1) {
            var $confirm = confirm("Are you sure you want to remove?");   
            if($confirm) {
                loader.showPleaseWait();              
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
                    requestData.callback = '?';                    
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data:requestData,
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
                });
            }            
        }
        else {
            showErrorModal("Sorry, but you have reached the minimum number of sub category section");            
        }
    }); 

    $("#manageCategorySection").on('click','#addCategorySectionProductPanel',function (e) { 
        var $this = $(this);
        var value = $('#addCategorySectionValue option:selected').val();
        var url = $this.data("url");
              
        var count = parseInt($(".categorySectionCount").last().text());
        if(isNaN(count) || count < minimumCategorySectionProductPanel) {            
            
            loader.showPleaseWait();                                   
            var requestData = {
                value:value,
                userid:userid
            };
            
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {             
                requestData.hash = hash;
                requestData.callback = '?';                
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
        }
        else {
            showErrorModal("Sorry, but you have reached the maximum number of category section")
        }
  
    });   

    $("#manageNewArrivals").on('click','.removeNewArrival',function (e) { 
        var $this = $(this);
     
        var index = $this.data("index").toString();
        var nodename = $this.data("nodename");
        var url = $this.data("url");
        var requestData = {
            index:index,
            nodename:nodename,
            userid:userid
        };

        var flag = 0;
        var count = parseInt($(".newArrivalsCount").last().text());
 
        if(count > 1) {
            loader.showPleaseWait();                             
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {             
                requestData.hash = hash;
                requestData.callback = '?';                
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
        }     
    }); 

    $("#manageTopSellers").on('click','#addTopSellers',function (e) { 
        var $this = $(this);
        var url = $this.data("url");
        var value = $this.closest("form").find("#value").val().trim();

        if(value !== "") {
            loader.showPleaseWait();           
            
            var requestData = {
                value:value,
                userid:userid                
            };

            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {
                requestData.hash = hash;
                requestData.callback = '?';
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
        }     
    }); 

    $("#manageBrands").on('click','.removeBrands',function (e) {      
        var $this = $(this);
        var index = $this.data("index").toString();
        var nodename = $this.data("nodename");
        var url = $this.data("url");       
        var flag = 0;
        var count = parseInt($(".brandsCount").last().text());
        if(count > 1) {
            loader.showPleaseWait();     
                        
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
                requestData.callback = '?';
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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

        }     
    }); 

    $("#manageBrands").on('click','#addBrandsBtn',function (e) { 
        loader.showPleaseWait();
        var $this = $(this);
        var value = $('#addBrandsDropDown option:selected').val();
        var url = $this.data("url");
        
        var requestData = {
            value:value,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            requestData.callback = '?';
            $.ajax({
                type: 'GET',
                url: url,
                data: requestData,
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

    });    

    $("#manageTopProducts").on('click','#addTopProducts',function (e) { 
        var url = $(this).data("url");
        var value = $(this).closest("form").find("#value").val().trim();
        var hash =  hex_sha1(value + userid + password);
        if(value !== ""){
            data = {value:value, userid:userid, hash:hash, callback:'?'};
            loader.showPleaseWait();           
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
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
        }
        else {
            showErrorModal("Enter Product Slug");
        }
    }); 

    $("#manageTopProducts").on('click','.removeTopProducts',function (e) { 
     
        var index = $(this).data("index").toString();
        var nodename = $(this).data("nodename");
        var url = $(this).data("url");

        var hash =  hex_sha1(index + nodename + userid + password);
        data = { index: index, nodename:nodename, userid:userid, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".topProductsCount").last().text());
        if(count > 1) {
            loader.showPleaseWait();     
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
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
        data = { index: index, nodename:nodename, userid:userid, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".topSellersCount").last().text());
        if(count > 1) {
            loader.showPleaseWait();     
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
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
        var $this = $(this);
        var $form = $this.closest("form");
        var url = $this.data("url");
        var value = $form.find("#value").val().trim();
        var target = $form.find("#target").val().trim();

        var requestData = {
            value:value,
            target:target,
            userid:userid           
        };

        if(value !==  "" && target !== "") {
            loader.showPleaseWait();                       
            $.ajax({
                url: "/hasher",
                data: requestData,
                dataType:"JSON",
            }).success(function(hash) {             
                requestData.hash = hash;                
                $.ajax({
                    type: 'GET',
                    url: url,
                    data:requestData,
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
        }
        else {
            showErrorModal("Empty Text or Empty Target Not Allowed");
        }
    });


    $("#navigation_others").on('click','#addOtherCategory',function (e) { 
        loader.showPleaseWait();           
        var url = $(this).data("url");
        var value = $('#drop_otherCategories option:selected').val();      
        var hash =  hex_sha1(value + userid + password);
        data = {value:value, userid:userid, hash:hash, callback:'?'};
        
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
        data = {index:index, value:value, userid:userid, hash:hash, callback:'?'};

        $.ajax({
            type: 'GET',
            url: url,
            data:data,
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
        data = {index:index, value:value, userid:userid, hash:hash, callback:'?'};
        $.ajax({
            type: 'GET',
            url: url,
            data:data,
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
        data = {index:index, value:value, userid:userid, hash:hash, callback:'?'};

        $.ajax({
            type: 'GET',
            url: url,
            data:data,
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
        var value = $(this).closest("form").find("#editTopProductsValue").val().trim();     
        var hash =  hex_sha1(index + value + userid + password);
        data = {index:index, value:value, userid:userid, hash:hash, callback:'?'};
        if(value !== ""){
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
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
        }
        else {
            showErrorModal("Empty Slug Not Available");
        }
    }); 

    $("#editNewArrival").on('click','#editNewArrivalSubmit',function (e) { 
        loader.showPleaseWait();           
        var index = $(this).closest("form").find("#editNewArrivalIndex").val();
        var url = $(this).closest("form").find("#editNewArrivalUrl").val();
        var value = $(this).closest("form").find("#editNewArrivalValue").val().trim();
        var target = $(this).closest("form").find("#editNewArrivalTarget").val().trim();
        var hash =  hex_sha1(index + value + target + userid + password);
        data = {index:index, value:value, target:target, userid:userid, hash:hash, callback:'?'};

        if (value !== "" && target !== "") {
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
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
        else {
            showErrorModal("Empty Value or Empty Target Not Allowed");
        }
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
        data = { index: index, nodename:nodename, userid:userid, hash:hash, callback:'?'};

        var flag = 0;
        var count = parseInt($(".otherCategoriesCount").last().text());
 
        if(count > 1) {
            loader.showPleaseWait();     
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
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
        data = { index: index, subIndex:subIndex, value:value, userid:userid, hash:hash, callback:'?'};
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
        formSubmitted = 1;        
        loader.showPleaseWait();          
        var index = $(this).closest("form").find("#index").val();
        var value = $(this).closest("form").find("#drop_actionType option:selected").val();
        var imageCount = $(this).closest("form").find("#drop_actionType option:selected").data('count');
        var url = $(this).data("url");
        var hash = hex_sha1(index + value + userid + password);
        data = { index: index, value:value, userid:userid, hash:hash, callback:'?'};
        var count = parseInt($(".slideCount_" + index).last().text());
        var currentSliderTemplate = $("#sliderTemplate" + index).val();
        if(isNaN(count) || (count >= imageCount)) {
            $.ajax({
                type: 'GET',
                url: url,
                data:data,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    loader.hidePleaseWait();        
                    $("#sliderTemplate" + index).val(value); 
                    $(".templateSlider_" + index).text(value);                                   
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });    
            getSliderPreview();                        
        }
        else {
            $(this).closest("form").find('#drop_actionType option[value="'+ currentSliderTemplate +'"]').attr("selected", "selected");
            showErrorModal("Sorry, but the minimum number of images for this slide design template is " + imageCount + " images");
        }
 
   
    });  

    $("#manageSliderSection").on('click','#commitSliderChanges',function (e) { 
        formSubmitted = 0;
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
        data = { index: index, value:categoryName, userid:userid, hash:hash, callback:'?'};
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
        loader.showPleaseWait();          
        $(editSlideForm_).ajaxForm({

            url: url,
            type: 'GET', 
            dataType: 'jsonp',
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
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(json) {
                loader.hidePleaseWait();  
                $(form).find("#sellerFile").val("");
                $("#setSellerHeadSection").load("getSellerSection");
                
            },
            error: function(e) {
                loader.hidePleaseWait();   
                $(form).find("#sellerFile").val("");
                $("#setSellerHeadSection").load("getSellerSection");                
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

    function setPositionParentSlider(url, data, index, action)
    {
        $.ajax({
            type: 'GET',
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
        index = (action === "down") ? index + 1: index - 1;
        $( "#manageSliderSection" ).load("getAllSliders", function( response, status, xhr ) {
            var accordionId = "#collapse_" + index;
            if ( status !== "error" ) {
                var aTag = $("a[href='"+ accordionId +"']");
                $('html,body').animate({scrollTop: aTag.offset().top},'slow');                        
            }
            $(accordionId).addClass("in");
        });          

    }    

    function getSliderPreview()
    {
        var commit = 0;
                
        var requestData = {
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            $.ajax({
                type: 'POST',
                data: {hash:hash, commit:commit},
                url: "getSliderPreview",
                dataType: 'json',
                success: function(json) {
                    $("#sliderPreview").html(json.html);  
                    loader.hidePleaseWait();                    
                },
            });         
            
        });

    }


    function addSubSlider(mainSlideForm, url, tableSelector, reloadurl, count, index)
    {
        $(mainSlideForm).ajaxForm({

            url: url,
            type: 'GET', 
            dataType: 'jsonp',
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

        var nodename = $(this).data("nodename");
        if(nodename == "addMainSlider") {

            var index = parseInt($(this).data("index"));
            var tempIndex = parseInt($("#collapse_"+index).find(".subSlide_"+index).last().text());
            tempIndex = isNaN(tempIndex) ? 0 : tempIndex;
            var subSlideIndex = isNaN(tempIndex) ? 0 : tempIndex;
            var template = $(".templateSlider_"+index).text();

            setImagesCropSizes(template, subSlideIndex, tempIndex, "mainSlider");

            $("#clonedSliderCountConstant").text(template);
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
            tempIndex = isNaN(subindex) ? 0 : subindex;            
            var tempIndex = tempIndex + 1;
            var template = $(".templateSlider_"+index).text();

            setImagesCropSizes(template, subindex, tempIndex, "mainSlider");            

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
            setImagesCropSizes(0, null, null, "adsImage");               
            var actionLink = newHomeCmsLink + "/addAdSection";
            $(".cropFormButton").attr("id","addAdSection");            
            $(".cropFormButton").attr("data-url",actionLink);             
            $("#previewImage").find("form").attr("action",actionLink);    
            $("#previewImage").find("#displayFormGroup").css("display","block");

        }
        else if(nodename == "editAds"){
            setImagesCropSizes(0, null, null, "adsImage");  
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
    $("#photoFile").on("click", function(){
        if($(this).val() !== "") {
            return false;
        }
    });

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

    $(' #previewImage').on('shown.bs.modal', function () {
        $("#photoFile").val("");       
    });      
    
    $(' #previewImage').on('hidden.bs.modal', function () {
        $(".cropFormButton").show();        
        $("#cropError").html("");        
        $("#contentPreview").find("#photoFile").val("");
        jcrop_api = $.Jcrop($('#user_image_prev'));  
        resetCoords();        
        jcrop_api.destroy();         
        $("#scaleAndCrop").css("display","none");        
    });  

    function setImagesCropSizes(template, subSlideIndex, tempIndex, type)
    {
        var requestData = {
            index:subSlideIndex, 
            template:template, 
            currentSliderCount:tempIndex,
            type:type,
            userid:userid
        };

        $.ajax({
            url: "/hasher",
            data: requestData,
            dataType:"JSON",
        }).success(function(hash) {
            requestData.hash = hash;
            $.ajax({
                type: 'GET',
                url: newHomeCmsLink + "/getTemplateImageDimension",
                data:requestData,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                success: function(json) {
                    var array = json.sites[0].success.split(',');       
                    $(".templateWidth").text(array[0]);  
                    $(".templateHeight").text(array[1]);
                },
                error: function(e) {
                    loader.hidePleaseWait();
                }
            });  
        });   

    } 

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
                    var customWidth = $(".templateWidth").html();
                    var customHeight = $(".templateHeight").html();
                    if(width >10 && height > 10 && width <= 5000 && height <= 5000) {

                        if(width < customWidth || height < customHeight) {
                            $(".cropFormButton").hide();
                            showErrorModal("Sorry, but the dimensions of the image must be at least "+customWidth+"px x "+customHeight+"px.");
                            $("#previewImage").modal("hide");
                        }
                        jcrop_api = $.Jcrop($('#user_image_prev'),{
                            aspectRatio: customWidth/customHeight,
                            allowSelect: false,
                            setSelect:[0,0,width*0.5,height*0.5],
                            boxWidth: 500,
                            boxHeight: 500,
                            minSize: [customWidth,customHeight],
                            onChange: showCoords,
                            onSelect: showCoords,
                            onRelease: resetCoords
                        });    
                        

                        $(' #previewImage').bind('hidden.bs.modal', function () {
                            $(".cropFormButton").show();
                            $("#cropError").html("");
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
            $("#cropForm").modal("hide");
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

