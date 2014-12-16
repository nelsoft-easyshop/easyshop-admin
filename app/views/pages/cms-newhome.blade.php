@extends('layouts.default')

@section('description', 'Home Content Manager - Home Page')
@section('keywords', '')
@section('title', 'Home CMS | Easyshop Admin')
@section('header_tagline', 'Home Content Manager - Home Page')

@section('page_header')
    @include('includes.header')
@stop

@section('content')

    <link type="text/css" href="{{{ asset('css/src/jquery.Jcrop.min.css') }}}" rel="stylesheet"  media="screen"/>   
    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>
    <style type="text/css">.jcrop-holder{margin: auto !important;}</style>
    <span id='newHomeCmsLink' style="display:none;">{{$newHomeCmsLink}}</span>
    <div class="row">
        <section id="tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">

                <li class="active"><a href="#manageSliderSection" role="tab"  data-toggle="tab">Manage Slider Section</a></li>                
                <li><a href="#manageBrands" role="tab"  data-toggle="tab">Manage Brands Section</a></li>                

                <li><a href="#manageCategorySection" role="tab"  data-toggle="tab">Manage Category Section</a></li>                
                <li><a href="#manageAdSection" role="tab"  data-toggle="tab">Manage Ad Section</a></li>                
                <li ><a href="#manageSellerSection" role="tab"  data-toggle="tab">Manage Seller Section</a></li>                
                <li class="dropdown"  >
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Manage Category Navigation<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <li role="presentation" class="dropdown-header">Category Navigations</li>
                        <span style="display:none;">{{{ $nav = 0 }}}</span>
                            @foreach($categoryNavigation as $navigation)
                                <li><a href="#navigation_{{{$navigation->categorySlug}}}_{{$nav}}" id="mainNavigation_{{{$nav}}}" class="mainNavigation_{{{$navigation->categorySlug}}}" tabindex="-1" role="tab" data-toggle="tab">{{{ucwords(str_replace("-"," ",$navigation->categorySlug))}}}</a></li>
                                <span style="display:none;">{{{ $nav++ }}}</span>
                            @endforeach
                        <li class="divider"></li>
                            <li  role="presentation" class="dropdown-header">New Arrivals</li>
                            <li><a href="#manageNewArrivals" role="tab"  data-toggle="tab">Manage New Arrivals</a></li>                

                        <li class="divider"></li>
                            <li role="presentation" class="dropdown-header">Top Products</li>  
                            <li><a href="#manageTopProducts" tabindex="-1" role="tab" data-toggle="tab">Manage Top Products</a></li>                

                        <li class="divider"></li>
                            <li role="presentation" class="dropdown-header">Top Sellers</li> 
                            <li><a href="#manageTopSellers" tabindex="-1" role="tab" data-toggle="tab">Manage Top Sellers</a></li>                

                        <li class="divider"></li>
                            <li role="presentation" class="dropdown-header">Other Categories</li> 
                            <li><a href="#navigation_others" tabindex="-1" role="tab" data-toggle="tab">Other Categories</a></li>

                    </ul>
                </li>
            </ul>
        </section>

        {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
        {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}           
        {{ Form::hidden('editCategoryLink',  "$newHomeCmsLink/setSubCategories", array('id' => 'editCategoryLink','class' => 'form-control')) }}           
        {{ Form::hidden('removeCategoryLink', "$newHomeCmsLink/removeContent", array('id' => 'removeCategoryLink','class' => 'form-control')) }}           
        <div id="myTabContent" class="tab-content">



            <div class="tab-pane fade" id="manageBrands">
                    <legend>        
                        <h4 class="tbl-title">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Manage Brands Section
                        </h4>
                    </legend>  

                    <form id='left' target="test"  class="form-horizontal">                                          
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Select Brand Name</label>
                            <div class="col-sm-10">
                                <select name="c_stateregion" id="addBrandsDropDown"  class="form-control">
                                    @foreach($allBrandsLists as $allBrands)
                                        <option value="{{{$allBrands->id_brand}}}">{{{$allBrands->name}}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                        </div>                                                                                   
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addBrands" id="addBrandsBtn">Add</a>
                            </div>
                        </div>                                      
                    </form> 

                    <table class="table table-striped table-hover tbl-my-style" id="addBrandsTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Product Slug</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$brandsCount=1}}</span>                               
                        <span style="display:none;">{{$brandsIndex=0}}</span>                             
                        @foreach($brandsLists as $brands)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editBrands" 
                                                data-toggle="modal" data-target="#editBrandsModal"
                                                data='{"url":"{{$newHomeCmsLink}}/setBrands","index":"{{$brandsIndex}}","value":"{{$brands->name}}","id_brand":"{{$brands->id_brand}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeBrands"
                                                    data-nodename="brands" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$brandsIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$brands->name}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="brandsCount">{{$brandsCount++}}</span>                               
                        <span style="display:none;">{{$brandsIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                  <!--Start topProducts Modal -->
                        <div class="modal fade user_modal" id="editBrandsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Brands</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal"> 
                                            <div class="form-group">
                                                <label for="userId" class="col-sm-2 control-label">Select Brand</label>
                                                <div class="col-sm-10">
                                                    <select name="c_stateregion" id="editBrandsDropDown"  class="form-control">
                                                        @foreach($allBrandsLists as $allBrands)
                                                            <option value="{{{$allBrands->id_brand}}}">{{{$allBrands->name}}}</option>
                                                        @endforeach
                                                    </select>                                                  </div>
                                            </div>                                               
                                            {{ Form::hidden('index', "", array('id' => 'editBrandsIndex','class' => 'form-control')) }}                                                                                              
                                            {{ Form::hidden('url', "", array('id' => 'editBrandsUrl','class' => 'form-control')) }}                                                                                              

                                            <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setBrands" id="editBrandsSubmit">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                  <!--End topProducts Modal -->
            </div> 



            <div class="tab-pane fade" id="manageTopSellers">
                    <legend>        
                        <h4 class="tbl-title">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Manage Top Sellers
                        </h4>
                    </legend>  

                    <form id='left' target="test"  class="form-horizontal">                                          
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Add Seller Slug</label>
                            <div class="col-sm-10">
                                <input type="text" id="value" name='value' class='form-control'> 
                            </div>
                        </div>                                                                                   
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addTopSellers" id="addTopSellers">Add</a>
                            </div>
                        </div>                                      
                    </form> 

                    <table class="table table-striped table-hover tbl-my-style" id="addTopSellersTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Product Slug</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$topSellersCount=1}}</span>                               
                        <span style="display:none;">{{$topSellersIndex=0}}</span>                             
                        @foreach($topSellers[0] as $sellers)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editTopSellers" id="editTopSellersBtn" 
                                                data-toggle="modal" data-target="#editTopSellers"
                                                data='{"url":"{{$newHomeCmsLink}}/setTopSellers","index":"{{$topSellersIndex}}","value":"{{$sellers}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeTopSellers"
                                                    data-nodename="topSellers" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$topSellersIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$sellers}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="topSellersCount">{{$topSellersCount++}}</span>                               
                        <span style="display:none;">{{$topSellersIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                  <!--Start topProducts Modal -->
                        <div class="modal fade user_modal" id="editTopSellers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Top Sellers</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal"> 
                                            <div class="form-group">
                                                <label for="userId" class="col-sm-2 control-label">Value</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="editTopSellersValue" name='value' value="/" class='form-control'> 
                                                </div>
                                            </div>                                               
                                            {{ Form::hidden('index', "", array('id' => 'editTopSellersIndex','class' => 'form-control')) }}                                                                                              
                                            {{ Form::hidden('url', "", array('id' => 'editTopSellersUrl','class' => 'form-control')) }}                                                                                              

                                            <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setTopSellers" id="editTopSellersSubmit">Edit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                  <!--End topProducts Modal -->
            </div> 










            <div class="tab-pane fade" id="manageTopProducts">
                    <legend>        
                        <h4 class="tbl-title">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Manage Top Products
                        </h4>
                    </legend>  

                    <form id='left' target="test"  class="form-horizontal">                                          
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Enter Product Slug</label>
                            <div class="col-sm-10">
                                <input type="text" id="value" name='value' class='form-control'> 
                            </div>
                        </div>                                                                                   
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addTopProducts" id="addTopProducts">Add</a>
                            </div>
                        </div>                                      
                    </form> 

                    <table class="table table-striped table-hover tbl-my-style" id="addTopProductsTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Product Slug</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$topProductsCount=1}}</span>                               
                        <span style="display:none;">{{$topProductsIndex=0}}</span>                             
                        @foreach($topProducts[0] as $products)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editTopProducts" id="editTopProductsBtn" 
                                                data-toggle="modal" data-target="#editTopProducts"
                                                data='{"url":"{{$newHomeCmsLink}}/setTopProducts","index":"{{$topProductsIndex}}","value":"{{$products}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeTopProducts"
                                                    data-nodename="topProducts" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$topProductsIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$products}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="topProductsCount">{{$topProductsCount++}}</span>                               
                        <span style="display:none;">{{$topProductsIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                  <!--Start topProducts Modal -->
                        <div class="modal fade user_modal" id="editTopProducts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Top Products</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal"> 
                                            <div class="form-group">
                                                <label for="userId" class="col-sm-2 control-label">Value</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="editTopProductsValue" name='value' value="/" class='form-control'> 
                                                </div>
                                            </div>                                               
                                            {{ Form::hidden('index', "", array('id' => 'editTopProductsIndex','class' => 'form-control')) }}                                                                                              
                                            {{ Form::hidden('url', "", array('id' => 'editTopProductsUrl','class' => 'form-control')) }}                                                                                              

                                            <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setTopProducts" id="editTopProductsSubmit">Edit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                  <!--End topProducts Modal -->
            </div> 

            <div class="tab-pane fade" id="manageNewArrivals">
                    <legend>        
                        <h4 class="tbl-title">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Manage New Arrivals
                        </h4>
                    </legend>  
                    <form id='left' target="test"  class="form-horizontal">                                          
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Enter Text</label>
                            <div class="col-sm-10">
                                <input type="text" id="value" name='value' class='form-control'> 
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Target</label>
                            <div class="col-sm-10">
                                <input type="text" id="target" name='value' value="/" class='form-control'> 
                            </div>
                        </div>                                                                                 
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addNewArrival" id="addNewArrival">Add</a>
                            </div>
                        </div>                                      
                    </form> 

                    <table class="table table-striped table-hover tbl-my-style" id="newArrivalsTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Text</th>
                            <th>Target</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$newArrivalsCount=1}}</span>                               
                        <span style="display:none;">{{$newArrivalsIndex=0}}</span>                               
                        @foreach($newArrivals as $arrivals)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editNewArrival" id="editNewArrivalBtn" 
                                                data-toggle="modal" data-target="#editNewArrival"
                                                data='{"url":"{{$newHomeCmsLink}}/setNewArrival","index":"{{$newArrivalsIndex}}","value":"{{$arrivals->text}}", "target":"{{$arrivals->target}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeNewArrival"
                                                    data-nodename="newArrival" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$newArrivalsIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$arrivals->text}}</td>
                                <td class="otherCategoriesTD">{{$arrivals->target}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="newArrivalsCount">{{$newArrivalsCount++}}</span>                               
                        <span style="display:none;">{{$newArrivalsIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                  <!--Start Edit New Arrival Modal -->
                        <div class="modal fade user_modal" id="editNewArrival" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Other Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal"> 
                                            <div class="form-group">
                                                <label for="userId" class="col-sm-2 control-label">Value</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="editNewArrivalValue" name='value' value="/" class='form-control'> 
                                                </div>
                                            </div>                                               
                                            <div class="form-group">
                                                <label for="userId" class="col-sm-2 control-label">Target</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="editNewArrivalTarget" name='value' value="/" class='form-control'> 
                                                </div>
                                            </div>                                                                                       
                                          
                                            {{ Form::hidden('index', "", array('id' => 'editNewArrivalIndex','class' => 'form-control')) }}                                                                                              
                                            {{ Form::hidden('url', "", array('id' => 'editNewArrivalUrl','class' => 'form-control')) }}                                                                                              

                                            <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setOtherCategories" id="editNewArrivalSubmit">Edit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                  <!--End Edit New Arrival Modal -->
            </div> 

            <div class="tab-pane fade" id="manageCategorySection">
                    <form id='changeProductPanel' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Add Category Section
                            </h4>
                        </legend>                         
 
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                            <div class="col-xs-10">
                                <select name="c_stateregion" id="addCategorySectionValue"  class="form-control">
                                    @foreach($categoryLists as $categories)
                                        @if($categories["name"] !== "PARENT")
                                            <option value="{{{$categories['slug']}}}">{{{$categories["name"]}}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>                                                                                 
                                                                                               
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addCategorySection" id="addCategorySectionProductPanel">Add Product Panel</a>
                            </div>
                        </div>
                    <span style="display:none;">{{$categorySectionIndex = 0}}</span>
                    <span style="display:none;">{{$categorySectionCount = 1}}</span>
                    </form>   
                    <div class="panel-group" id="accordion">
                        @foreach($categorySection as $categoryPanel)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_category_{{$categorySectionIndex}}" style='cursor:pointer;'>{{ucwords(str_replace("-"," ",$categoryPanel->categorySlug))}}</a>
                                            <span class="glyphicon glyphicon-remove pull-right" id="removeCategorySection" data-nodename="categorySectionPanel" style='cursor:pointer;' data-index="{{$categorySectionIndex}}" data-url="{{$newHomeCmsLink}}/removeContent"></span>
                                        </h4>
                                    </div>
                                    
                                    <div id="collapse_category_{{$categorySectionIndex}}" class="panel-collapse collapse">
                                        <div class="panel-body" id="productPanelDivsss">

                                            <!-- Start Add Sub Category Section -->

                                            <form id='left' target="test"  class="form-horizontal">            
                                                <legend>        
                                                    <h4 class="tbl-title">
                                                        <span class="glyphicon glyphicon-list-alt"></span>
                                                        Add Sub Category
                                                    </h4>
                                                </legend>     

                                                {{ Form::hidden('index', "$categorySectionIndex", array('id' => 'index','class' => 'form-control')) }}                                                        
                                                <div class="form-group">
                                                    <label for="inputPassword" class="control-label col-xs-2">Sub Category Text</label>
                                                    <div class="col-xs-10">
                                                        <input type="text" id="subCategoryText" name='subCategoryText' class='form-control'> 
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="inputPassword" class="control-label col-xs-2">Sub Category Target</label>
                                                    <div class="col-xs-10">
                                                        <input type="text" id="subCategorySectionTarget" name='subCategorySectionTarget' class='form-control'> 
                                                    </div>
                                                </div>                                                                                                        
                                                <div class="form-group">
                                                    <div class="col-xs-offset-2 col-xs-10">
                                                        <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addSubCategorySection" id="addSubCategorySection">Add Sub Category</a>
                                                    </div>
                                                </div>                                      
                                            </form> 

                                            <!-- End Add Sub Category Section -->


                                            <!-- Start Manage Sub Category Section -->
                                             <table class="table table-striped table-hover tbl-my-style subCategoriesSectionTable"  id="subCategoriesSection_{{{$categorySectionIndex}}}">
                                                <thead>
                                                <tr>
                                                    <th>/</th>
                                                    <th>Text</th>
                                                    <th>Target</th>

                                                <!-- HERE -->
                                                </tr>
                                                </thead>
                                                <tbody id="tbody_boxContent">
                                                <span style="display:none;">{{{ $subCategorySection = 0 }}}</span>
                                                    @foreach($categoryPanel->sub as $subCategoriesSection)
                                                        <tr id="row_{{$categorySectionIndex}}_{{$subCategorySection}}">
                                                            <td>
                                                                <div class="btn-toolbar" role="toolbar">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-danger editCategorySection" id="data_{{$categorySectionIndex}}_{{$subCategorySection}}" 
                                                                            data-toggle="modal" data-target="#modalForCategorySection"
                                                                            data='{"url":"{{{$newHomeCmsLink}}}/setSubCategoriesSection","categorySectionIndex":"{{{  $categorySectionIndex }}}","subCategorySectionIndex":"{{{ $subCategorySection }}}","value":"{{{ $subCategoriesSection->text }}}", "target":"{{{ $subCategoriesSection->target }}}" } '
                                                                            >
                                                                            <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn edit_btn removeCategorySection" id="data_{{$categorySectionIndex}}_{{$subCategorySection}}" 
                                                                                data-nodename="categorySection" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{{  $categorySectionIndex }}}" data-subindex = "{{{ $subCategorySection }}}"
                                                                            >
                                                                            <span class="glyphicon glyphicon-remove"></span>
                                                                        </button>
                                                                    </div>                                                    
                                                                </div>
                                                            </td>
                                                            <td id="value_{{$categorySectionIndex}}_{{$subCategorySection}}" class="subCategoryTD">{{{ $subCategoriesSection->text }}}</td>
                                                            <td id="value_{{$categorySectionIndex}}_{{$subCategorySection}}" class="subCategoryTD">{{{ $subCategoriesSection->target }}}</td>
                                                            <span style="display:none;"></span>                            
                                                            <input type="hidden" class="boxContentCount_" value="">
                                                        </tr>
                                                        <span style="display:none;" class="subCategorySectionCount_{{$categorySectionIndex}}">{{{ $subCategorySection++ }}}</span>
                                                    @endforeach

                                                </tbody> 
                                            </table>
   

                                            <!-- End Manage Sub Category Section -->


                                            <!-- Start Product Panel Category Section -->

                                            <form id='changeProductPanel' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                                                <legend>        
                                                    <h4 class="tbl-title">
                                                        <span class="glyphicon glyphicon-list-alt"></span>
                                                        Add Category Product Panel
                                                    </h4>
                                                </legend>                         
                         
                                                <div class="form-group">
                                                    <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                                    <div class="col-xs-10">
                                                        <input type="text" id="value" name='value' class='form-control'> 
                                                    </div>
                                                </div>                                                                                 
                                                                                                                       
                                                <div class="form-group">
                                                    <div class="col-xs-offset-2 col-xs-10">
                                                        <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addCategoryProductPanel" data-index="{{$categorySectionIndex}}" id="addCategoryProductPanel">Add Category Product Panel</a>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="col-lg-15" style='text-align:center;' id="categorySectionProductPanel_{{$categorySectionIndex}}">

                                                <span style="display:none;">{{$subCategorySectionIndex = 0}}</span>                                                
                                                <span style="display:none;">{{$categoryProductPanelCount = 1}}</span>                                                
                                                @foreach($categoryProductPanelList[$categorySectionIndex] as $categorySectionProducts)
                                                    <div style="position:relative;display:inline-block;">
                                                        <div class='well' style="height:auto;">
                                                            <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                                <img src="{{$easyShopLink}}{{ltrim($categorySectionProducts->product_image_path, '.')}}"class="img-responsive" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                            </div>
                                                            <a href="#categoryProductPanel_{{$categorySectionIndex}}_{{$subCategorySectionIndex}}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                            <a class="btn btn-default" 
                                                                id="removeCategoryProductPanel" 
                                                                data-index="{{$categorySectionIndex}}" 
                                                                data-subindex="{{$subCategorySectionIndex}}" 
                                                                data-nodename="categoryProductPanel" 
                                                                style="position:absolute;top:2px;left:5px;"
                                                                data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                             ><font color='red'><b>X</b></font></a>

                                                            <a 
                                                                id="moveupCategoryProductPanel" 
                                                                data-action="up" 
                                                                data-index="{{$categorySectionIndex}}" 
                                                                data-order="{{$subCategorySectionIndex}}" 
                                                                data-subindex="{{$subCategorySectionIndex}}" 
                                                                style="position:absolute;top:235px;left:5px;"
                                                                data-url = "{{{$newHomeCmsLink}}}/setPositionCategoryProductPanel"
                                                             ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                                             <a  
                                                                id="movedownCategoryProductPanel" 
                                                                data-action="down" 
                                                                data-index="{{$categorySectionIndex}}" 
                                                                data-order="{{$subCategorySectionIndex}}" 
                                                                data-subindex="{{$subCategorySectionIndex}}" 
                                                                style="position:absolute;top:235px;right:5px;"
                                                                data-url = "{{{$newHomeCmsLink}}}/setPositionCategoryProductPanel"
                                                             ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
                                                            <span class="categoryProductPanelCount" style="display:none;">{{$categoryProductPanelCount}}</span>

                                                        <!--Start Edit Slide Modal -->
                                                            <div class="modal fade user_modal" id="categoryProductPanel_{{$categorySectionIndex}}_{{$subCategorySectionIndex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                            <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Category Product Panel</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal">                                        
                                                                                <div class="form-group">
                                                                                    <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                                                                    <div class="col-xs-10">
                                                                                        <input type="text" id="value" name='value' value="{{$categorySectionProducts->slug}}" class='form-control'> 
                                                                                    </div>
                                                                                </div>    
                                                                              
                                                                                {{ Form::hidden('index', $categorySectionIndex, array('id' => 'index','class' => 'form-control')) }}                                                                                              
                                                                                {{ Form::hidden('subindex', $subCategorySectionIndex, array('id' => 'subindex','class' => 'form-control')) }}                                                                                              

                                                                                <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setCategoryProductPanel" id="editCategoryProductPanel">Edit Product Panel</button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!--End Edit Slide Modal -->                                                            

                                                        </div>
                                                    </div>
                                                <span style="display:none;" class="categoryProductPanelCount_{{$categorySectionIndex}}">{{$categoryProductPanelCount++}}</span>                                                                                                    
                                                <span style="display:none;">{{$subCategorySectionIndex++}}</span>                                                
                                                @endforeach
                                            </div>

                                            <!-- End Product Panel Category Section -->

                                        </div>
                                    </div>
                                    <span style="display:none;">{{$categorySectionIndex++}}</span>      
                                    <span style="display:none;" class='categorySectionCount'>{{$categorySectionCount++}}</span>

                                </div>
                        @endforeach
                    </div>

            </div>

            <div class="tab-pane fade" id="manageAdSection">
                    <form id='addAdsForm' target="test" action="{{ $newHomeCmsLink}}/addAdds" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                                              
                        <div id="cloneForm_addAds">
                            <div class="form-group" id="displayFormGroup" style='display:none;'>
                                <label for="inputPassword" class="control-label col-xs-2">Target</label>

                                <div class="col-sm-10">
                                    {{ Form::text('target',"/", array('id' => 'target','class' => 'form-control')) }}                        
                                </div>
                            </div>                             
                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                                    
                            {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                            {{ Form::hidden('hash', "", array('id' => "hashAddAds",'class' => 'form-control')) }}                        
                        </div>
                    </form>   


                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Manage Ads Panel <a href="#previewImage" class='pull-right' data-nodename="addAds" data-toggle="modal" id="addAdsCrop">Add Ads <span class="glyphicon glyphicon-plus"></span></a></a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body" id="adsSectionDiv">

                                    <span style="display:none;">{{$adsSectionIndex = 0}}</span>
                                    <span style="display:none;">{{$adsCount = 1}}</span>
                                    <div class="col-lg-15" style='text-align:center;'>
                                        @foreach($adSection[0] as $ads)
                                            <div style="position:relative;display:inline-block;">
                                                <div class='well' style="height:auto;">
                                                    <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                        <img src="{{$easyShopLink}}/{{$ads->img}}" class="img-responsive" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                    </div>

                                                    <a href="#previewImage" id="editAdsCrop" data-index="{{$adsSectionIndex}}" data-nodename="editAds" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span  data-index="{{$adsSectionIndex}}" data-nodename="editAds" class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>

                                                    <a class="btn btn-default" 
                                                        id="removeAdsSection" 
                                                        data-index="{{$adsSectionIndex}}" 
                                                        data-nodename="adsSection" 
                                                        style="position:absolute;top:2px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                     ><font color='red'><b>X</b></font></a>
                                                 </div>
                                                 <span class="adsCount" style="display:none;">{{$adsCount}}</span>
                                                <!--Start Edit Slide Modal -->
                                                    <div class="modal fade user_modal" id="adsPanel{{$adsSectionIndex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Product Panel</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                                                         
                                                                    <form id='adSectionForm{{$adsSectionIndex}}' target="test" action="{{ $newHomeCmsLink}}/setAdsSection" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                                                                        <div id="clone_editAdsCrop_{{$adsSectionIndex}}">
                                                                            {{ Form::hidden('index',$adsSectionIndex, array('id' => 'editAdsIndex','class' => 'form-control')) }}                        
                                                                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
                                                                            <div class="form-group" id="displayFormGroup" style='display:none;'>
                                                                                <label for="inputPassword" class="control-label col-xs-2">Target</label>

                                                                                <div class="col-sm-10">
                                                                                    {{ Form::text('target', $ads->target, array('id' => 'target','class' => 'form-control')) }}                        
                                                                                </div>
                                                                            </div>                                                                               
                                                                            {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                                                                            {{ Form::hidden('hash', "", array('id' => "editAdsSectionHash",'class' => 'form-control')) }}                        
                                                                        </div>

                                                                    </form>                                                                  
                                                                   
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!--End Edit Slide Modal -->

                                            <span style="display:none;">{{$adsSectionIndex++}}</span>  
                                            <span style="display:none;">{{$adsCount++}}</span>
                                            </div>
                                        @endforeach
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>   
            </div>







            <div class="tab-pane fade" id="manageSellerSection">
                    <form id='' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Change Seller Slug
                            </h4>
                        </legend>                         
                        {{ Form::hidden('action', "slug", array('id' => 'action','class' => 'form-control')) }}                        
                        {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                          
                        {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                            <div class="col-xs-10">
                                <input type="text" id="slug" name='slug' class='form-control'> 
                            </div>
                        </div>                                                                                 
                                                                                               
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSellerHead"  id="changeSellerSlug">Change Seller Slug</a>
                            </div>
                        </div>
                    </form>

                    <form id='changeSellerBannerForm' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Change Seller Banner
                            </h4>
                        </legend>                         
                        {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
 
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                            <div class="col-xs-10">
                                <input type="file" id="sellerFile" name='myfile' class='form-control'> 
                            </div>
                        </div>            
                        {{ Form::hidden('action', "banner", array('id' => 'action','class' => 'form-control')) }}                        
                        {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                        {{ Form::hidden('hash', "", array('id' => "hashChangeSellerBanner",'class' => 'form-control')) }}                        
                                                                                               
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSellerHead" data-prev="navigation_{{{$navigation->categorySlug}}}" id="changeSellerBannerSubmit">Change Seller Banner</a>
                            </div>
                        </div>
                    </form>

                    <form id='changeSellerLogoForm' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Change Seller Logo
                            </h4>
                        </legend>                         
                        {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
 
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                            <div class="col-xs-10">
                                <input type="file" id="sellerFile" name='myfile' class='form-control'> 
                            </div>
                        </div>                                                                                 
                        {{ Form::hidden('action', "logo", array('id' => 'action','class' => 'form-control')) }}                        
                        {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                        {{ Form::hidden('hash', "", array('id' => "hashChangeSellerLogo",'class' => 'form-control')) }}                        
                                                                                               
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSellerHead" id="changeSellerLogoSubmit">Change Seller Logo</a>
                            </div>
                        </div>
                    </form>   
                    <form id='changeProductPanel' target="test" action="{{ $newHomeCmsLink}}/setSellerHead" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Add Seller Product
                            </h4>
                        </legend>                         
 
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                            <div class="col-xs-10">
                                <input type="text" id="value" name='value' class='form-control'> 
                            </div>
                        </div>                                                                                 
                                                                                               
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addProductPanel" id="addProductPanel">Add Product Panel</a>
                            </div>
                        </div>
                    </form>   


                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Manage Seller Product Panel</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="panel-body" id="productPanelDiv">

                                    <span style="display:none;">{{$productPanelindex = 0}}</span>
                                    <span style="display:none;">{{$productPanelCount = 1}}</span>
                                    <div class="col-lg-15" style='text-align:center;'>
                                        @foreach($productList as $productPanel)
                                            <div style="position:relative;display:inline-block;">
                                                <div class='well' style="height:auto;">
                                                    <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                        <img src="{{$easyShopLink}}{{ltrim($productPanel->product_image_path, '.')}}" class="img-responsive" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                    </div>

                                                    <a href="#productPanel{{$productPanelindex}}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                    <a class="btn btn-default" 
                                                        id="removeProductPanel" 
                                                        data-index="{{$productPanelindex}}" 
                                                        data-nodename="productPanel" 
                                                        style="position:absolute;top:2px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                     ><font color='red'><b>X</b></font></a>
                                                 </div>
                                                 <span class="productPanelCount" style="display:none;">{{$productPanelCount}}</span>
                                                <!--Start Edit Slide Modal -->
                                                    <div class="modal fade user_modal" id="productPanel{{$productPanelindex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Product Panel</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal">                                        
                                                                        <div class="form-group">
                                                                            <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                                                            <div class="col-xs-10">
                                                                                <input type="text" id="value" name='value' value="{{$productPanel->slug}}" class='form-control'> 
                                                                            </div>
                                                                        </div>    
                                                                        {{ Form::hidden('index', $productPanelindex, array('id' => 'index','class' => 'form-control')) }}                                                                                              

                                                                        <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setSellerProductPanel" id="editProductPanel">Edit Product Panel</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!--End Edit Slide Modal -->

                                            <span style="display:none;">{{$productPanelindex++}}</span>  
                                            <span style="display:none;">{{$productPanelCount++}}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>   


            </div>            
            <span style="display:none;">{{{$index = 0}}}</span>                            
            @foreach($categoryNavigation as $navigation)
                <div class="tab-pane fade" id="navigation_{{{$navigation->categorySlug}}}_{{$index}}">
                    <form id='left' target="test"  class="form-horizontal">            
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Change Main Category Navigation
                            </h4>
                        </legend>                                   
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Main Category Name</label>
                            <div class="col-sm-10">
                                {{ Form::hidden('index', "$index", array('id' => 'index','class' => 'form-control')) }}                                                        
                                <select name="c_stateregion" id="drop_actionType"  class="form-control" data-index = "{{{ $index }}}">
                                    @foreach($categoryLists as $categories)
                                        @if($categories["name"] !== "PARENT")
                                            @if($categories["slug"] == $navigation->categorySlug)
                                                <option value="{{{$categories['slug']}}}" selected>{{{$categories["name"]}}} - ({{{$categories['slug']}}})</option>
                                            @else$categories["slug"]
                                                <option value="{{{$categories['slug']}}}">{{{$categories["name"]}}} - ({{{$categories['slug']}}})</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>                          
                                                           
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setMainCategories" data-prev="navigation_{{{$navigation->categorySlug}}}" id="setMainNavigation">Set Main Category Navigation</a>
                            </div>
                        </div>                                      
                    </form>      

                    <div class="tbl-div">                 
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Manage Sub Category Navigation
                            </h4>
                        </legend>  

                        <form id='left' target="test"  class="form-horizontal">                                          
                            <div class="form-group">
                                <div class="col-sm-10">
                                    {{ Form::hidden('index', "$index", array('id' => 'index','class' => 'form-control')) }}                        
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="userId" class="col-sm-2 control-label">Sub Category Slug</label>
                                <div class="col-sm-10">
                                    <select name="c_stateregion" id="drop_actionType"  class="form-control" data-status="">
                                        @foreach($childCategoryLists as $categories)
                                            <option value="{{{$categories['slug']}}}">{{{$categories["name"]}}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>                                                           
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addSubCategories" data-subcategories = "#subcategories_{{{$index}}}" id="addSubCategoryNavigation">Add Sub Category Navigation</a>
                                </div>
                            </div>                                      
                        </form>                                                                  
                        <table class="table table-striped"  id="tblSubcategories_{{{$index}}}">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Value</th>


                            </tr>
                            </thead>
                            <tbody id="tbody_boxContent">
                            <span style="display:none;">{{{ $subIndex = 0 }}}</span>
                                @foreach($navigation->sub->categorySubSlug as $subCategories)
                                    <tr id="row_{{$index}}_{{$subIndex}}">
                                        <td>
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger edit_btn" id="data_{{$index}}_{{$subIndex}}" 
                                                        data-toggle="modal" data-target="#myModal"
                                                        data='{"url":"{{{$newHomeCmsLink}}}/setSubCategories","index":"{{{  $index }}}","subIndex":"{{{ $subIndex }}}","value":"{{{ $subCategories }}}" } '
                                                        >
                                                        <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                                    </button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn edit_btn removeButton" id="data_{{$index}}_{{$subIndex}}" 
                                                        data='{"url":"{{{$newHomeCmsLink}}}/removeContent","index":"{{{  $index }}}","subIndex":"{{{ $subIndex }}}","value":"{{{ $subCategories }}}" } '
                                                        >
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </button>
                                                </div>                                                    
                                            </div>
                                        </td>
                                        <td id="value_{{$index}}_{{$subIndex}}" class="subCategoryTD">{{{ $subCategories }}}</td>
                                        <span style="display:none;"></span>                            
                                        <input type="hidden" class="boxContentCount_" value="">
                                    </tr>
                                    <span style="display:none;">{{{ $subIndex ++ }}}</span>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <span style="display:none;">{{{$index++}}}</span>   
            @endforeach
            <div class="tab-pane fade" id="navigation_others">
                    <legend>        
                        <h4 class="tbl-title">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Manage Other Categories
                        </h4>
                    </legend>  

                    <form id='left' target="test"  class="form-horizontal">                                          
                        <div class="form-group">
                            <div class="col-sm-10">
                                {{ Form::hidden('index', "test", array('id' => 'index','class' => 'form-control')) }}                        
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Add Other Category</label>
                            <div class="col-sm-10">
                                <select name="c_stateregion" id="drop_otherCategories"  class="form-control" data-status="">
                                    @foreach($childCategoryLists as $categories)
                                        <option value="{{{$categories['slug']}}}">{{{$categories["name"]}}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                                                           
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addOtherotherCategories" id="addOtherCategory">Add Other Category Navigation</a>
                            </div>
                        </div>                                      
                    </form> 

                     <table class="table table-striped table-hover tbl-my-style" id="otherCategoriesTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Categories</th>

                        <!-- HERE -->
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$otherCategoriesCount=1}}</span>                               
                        <span style="display:none;">{{$otherCategoriesIndex=0}}</span>                               
                        @foreach($otherCategories[0]->categorySlug as $others)
                            <tr id="row_">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editOtherCategory" id="editOtherCategoryBtn" 
                                                data-toggle="modal" data-target="#editOtherCategory"
                                                data='{"url":"{{$newHomeCmsLink}}/setOtherCategories","index":"{{$otherCategoriesIndex}}","value":"{{$others}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeOtherCategory"
                                                    data-nodename="otherCategories" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$otherCategoriesIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$others}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="otherCategoriesCount">{{$otherCategoriesCount++}}</span>                               
                        <span style="display:none;">{{$otherCategoriesIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>

                  <!--Start Edit Other Category Modal -->
                        <div class="modal fade user_modal" id="editOtherCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Other Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal"> 
                                            <div class="form-group">
                                                <label for="userId" class="col-sm-2 control-label">Add Other Category</label>
                                                <div class="col-sm-10">
                                                    <select name="c_stateregion" id="drop_otherCategories_edit"  class="form-control" data-status="">
                                                        @foreach($childCategoryLists as $categories)
                                                            <option value="{{{$categories['slug']}}}">{{{$categories["name"]}}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>                                                                                    
                                          
                                            {{ Form::hidden('index', "", array('id' => 'editOtherIndex','class' => 'form-control')) }}                                                                                              
                                            {{ Form::hidden('url', "", array('id' => 'editOtherUrl','class' => 'form-control')) }}                                                                                              

                                            <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setOtherCategories" id="editOtherCategorySubmit">Edit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                  <!--End Edit Other Category Modal -->
            </div> 

            <span id="clonedSliderCountConstant" style="display:none;"></span>   
            <div class="tab-pane fade active in" id="manageSliderSection">
                <div class="row">
                    <div class='col-md-12'>
                        <center>
                            <a1 href="#" class="btn btn-success text-center" id="commitSliderChanges">Commit Slider Changes
                            </a1>
                            <a1 href="#" class="btn btn-danger text-center" id="discardChanges" data-url="{{$newHomeCmsLink}}/syncTempHomeFiles">Discard Current Slider Settings
                            </a1>                                                        
                        </center>
                    </div>
                </div>                  
                <legend>     
                    <h4 class="tbl-title">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        Current Slider Section 
                    </h4>
                </legend> 
                <div id="sliderPreview">
                    <div class="row">
                        <div class='col-md-12'>
                           <iframe id="iframe" class="well" style='min-height:551px !important;min-width:100%;'
                                   src="{{{$newHomeCmsLink}}}/fetchPreviewSlider">
                           </iframe>
                       </div>
                    </div> 
                </div>

                <legend>     
                    <h4 class="tbl-title">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        Add Main Slider Section
                    </h4>
                </legend>  
                <form id='left' target="test"  class="form-horizontal">                                          
                    <div class="form-group">
                        <label for="userId" class="col-sm-2 control-label">Choose Slider Design Template</label>
                        <div class="col-sm-10">
                            <select name="c_stateregion" id="drop_actionType"  class="form-control" data-status="">
                                @foreach($templateLists[0] as $templates)                                               
                                    <option value="{{$templates->templateName}}" >{{$templates->templateName}}</option>
                                @endforeach  
                            </select>
                        </div>
                    </div>                                                           
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addSliderSection" data-subcategories = "#subcategories_test" id="addMainSlider">Add Main Slider</a>
                        </div>
                    </div>                                      
                </form>
                @foreach($templateLists[0] as $templates)                                               
                    <span id="template_{{$templates->templateName}}" data-name="{{$templates->templateName}}" data-count="{{$templates->imageCount}}" style="display:none;">{{$templates->templateName}}</span>
                @endforeach                  
                <span style="display:none;">{{$sliderIndex = 0}}</span>
                <span style="display:none;">{{$parentSliderCount = 1}}</span>
                <div class="panel-group" id="accordion">
                    @foreach($sliderSection as $slides)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$sliderIndex}}">Manage Slides</a>
                                    <span class="glyphicon glyphicon-remove pull-right" id="removeMainSlider" data-nodename="mainSliderSection" data-index="{{$sliderIndex}}" data-url="{{$newHomeCmsLink}}/removeContent" style='cursor:pointer;'></span>
                                    <span class="glyphicon glyphicon-chevron-up pull-right" id="moveParentSlider" data-nodename="mainSliderSection" data-action="up" data-index="{{$sliderIndex}}" data-url="{{$newHomeCmsLink}}/setPositionParentSlider" style='cursor:pointer;'></span>
                                    <span class="glyphicon glyphicon-chevron-down pull-right" id="moveParentSlider" data-nodename="mainSliderSection" data-action="down" data-index="{{$sliderIndex}}" data-url="{{$newHomeCmsLink}}/setPositionParentSlider" style='cursor:pointer;'></span>
                                </h4>
                            </div>
                            <div id="collapse_{{$sliderIndex}}" class="panel-collapse collapse">
                                <div class="panel-body"> 
                                    <!-- Add Main Slide Start -->
                                    <form id='left' target="test"  class="form-horizontal">         
                                        <input type="hidden" id="sliderTemplate{{$sliderIndex}}" value="{{$slides->template}}">                                  
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                {{ Form::hidden('index', $sliderIndex, array('id' => 'index','class' => 'form-control')) }}                        
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="userId" class="col-sm-2 control-label">Set Slider Design Template</label>
                                            <div class="col-sm-10">
                                                <select name="c_stateregion" id="drop_actionType"  class="form-control" data-status="">
                                                    @foreach($templateLists[0] as $templates)                                             
                                                        @if(strtolower(trim($templates->templateName)) == strtolower(trim($slides->template)))
                                                            <option value="{{$templates->templateName}}" data-count="{{$templates->imageCount}}" selected >{{$templates->templateName}}</option>
                                                        @else
                                                            <option value="{{$templates->templateName}}" data-count="{{$templates->imageCount}}" >{{$templates->templateName}}</option>
                                                        @endif
                                                    @endforeach  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-offset-2 col-xs-10">
                                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/setSliderDesignTemplate" id="setSliderDesignTemplate">Set Slider Design Template</a>
                                            </div>
                                        </div>  
                                    </form>
                                    <!-- Add Main Slide End -->

                                    <!-- Add Sub Slider Start -->  

                                    <form id='mainSlideForm{{$sliderIndex}}' target="test" action="{{ $newHomeCmsLink}}/addmainslide" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                                        <div id="cloneForm_addSubSlider">
                                            {{ Form::hidden('index', $sliderIndex, array('id' => 'modalSliderIndex','class' => 'form-control')) }}                                                        
                                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
                                            <div class="form-group" id="displayFormGroup" style="display:none;">
                                                <label for="inputPassword" class="control-label col-xs-2">Target</label>
                                                <div class="col-sm-10">
                                                    {{ Form::text('target', "/", array('id' => 'target','class' => 'form-control')) }}                        
                                                </div>
                                            </div>                                                                               
                                            {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                                            {{ Form::hidden('hash', "", array('id' => "hashMainSlide",'class' => 'form-control')) }}                        


                                        </div>
                                    </form>
                                    <!-- End Sub Slider Start -->

                                    <hr/>
                                    <div class="form-group ">
                                        <legend>        
                                            <h4 class="tbl-title">
                                                <span class="glyphicon glyphicon-list-alt"></span>
                                                Manage Sub Slider <a href="#previewImage" class='pull-right' data-index = "{{$sliderIndex}}" data-template ="{{$slides->template}}" data-nodename="addMainSlider" data-toggle="modal" id="addSliderCrop">Add Slider <span class="glyphicon glyphicon-plus"></span></a>
                                            </h4>
                                        </legend>                   
                      
                                        <div class="col-lg-15" style='text-align:center;' id="sliderReload_{{$sliderIndex}}">
                                            <span style="display:none;">{{$subSlideIndex=0}}</span>                      
                                            <span style="display:none;">{{$slideCount=1}}</span>  
                                            @foreach($slides->image as $subSlides)
                                                <div style="position:relative;display:inline-block;">
                                                    <div class='well' style="height:auto;">
                                                        <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                            <img src="{{$easyShopLink}}{{$subSlides->path}}" class="img-responsive" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;"/>
                                                        </div>

                                                        <a href="#previewImage" id="editSubSliderCrop" data-toggle="modal" data-index="{{$sliderIndex}}" data-subindex="{{$subSlideIndex}}" data-nodename="editMainSlider" style="position:absolute;top:235px;left:112px;"><span  href="" id="editSubSliderCrop" data-toggle="modal" data-index="{{$sliderIndex}}" data-subindex="{{$subSlideIndex}}" class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                        <a class="btn btn-default" 
                                                            id="removeSubSlide" 
                                                            data-index="{{$sliderIndex}}" 
                                                            data-subindex="{{$subSlideIndex}}" 
                                                            data-nodename="subSliderSection" 
                                                            style="position:absolute;top:2px;left:5px;"
                                                            data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                         ><font color='red'><b>X</b></font></a>

                                                        <a 
                                                            id="moveup" 
                                                            data-action="up" 
                                                            data-index="{{$sliderIndex}}" 
                                                            data-order="{{$subSlideIndex}}" 
                                                            data-subindex="{{$subSlideIndex}}" 
                                                            style="position:absolute;top:235px;left:5px;"
                                                            data-url = "{{{$newHomeCmsLink}}}/setSliderPosition"
                                                         ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                                         <a  
                                                            id="movedown" 
                                                            data-action="down" 
                                                            data-index="{{$sliderIndex}}" 
                                                            data-order="{{$subSlideIndex}}" 
                                                            data-subindex="{{$subSlideIndex}}" 
                                                            style="position:absolute;top:235px;right:5px;"
                                                            data-url = "{{{$newHomeCmsLink}}}/setSliderPosition"
                                                         ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
                                                     </div>
                                                     <span class="slideCount_{{$sliderIndex}}" style="display:none;">{{$slideCount}}</span>
                                                    <!--Start Edit Slide Modal -->
                                                    <div class="modal fade user_modal" id="myMain_{{$sliderIndex}}_{{$subSlideIndex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Box Content</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id='' target="test" action="{{ $newHomeCmsLink}}/editSubSlider" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                                                                        <div id="editSlideForm_{{$sliderIndex}}_{{$subSlideIndex}}">
                                                                            {{ Form::hidden('index', $sliderIndex, array('id' => 'editModalSliderIndex','class' => 'form-control')) }}                        
                                                                            {{ Form::hidden('subIndex', $subSlideIndex, array('id' => 'editModalSliderSubIndex','class' => 'form-control')) }}                        
                                                                            {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
                                                                            <div class="form-group" id="displayFormGroup" style="display:none;">
                                                                                <label for="inputPassword"  class="control-label col-xs-2">Target</label>
                                                                                <div class="col-sm-10">
                                                                                    {{ Form::text('target', $subSlides->target, array('id' => 'target','class' => 'form-control')) }}                        
                                                                                </div>
                                                                            </div>                                                                               
                                                                            {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                                                                            {{ Form::hidden('hash', "", array('id' => "editHashMainSlide",'class' => 'form-control')) }}                        
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End Edit Slide Modal -->

                                                <span style="display:none;">{{$subSlideIndex++}}</span>  
                                                <span style="display:none;" class='subSlide_{{$sliderIndex}}'>{{$slideCount++}}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span style="display:none;">{{$sliderIndex++}}</span>                            
                            <span style="display:none;" class="parentSliderCount">{{$parentSliderCount++}}</span>                            
                        </div>
                    @endforeach
                <div>                    
            </div>                      
        </div>
    </div>       

        <!-- HERE-->
        <!--Start Modal -->
        <div class="modal fade user_modal" id="modalForCategorySection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Box Content</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_categoryText_index" placeholder="Enter fullname">
                        </div>                          
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_categoryText_subIndex" placeholder="Enter fullname">
                        </div>                          
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_categoryText_url" placeholder="Enter fullname">
                        </div>                           
                        <div class="form-group">
                            <label>Enter Text: </label>
                            <input type="text" class="form-control" id="edit_categoryText" placeholder="Enter fullname">
                        </div>   
                        <div class="form-group">
                            <label>Enter Target: </label>                            
                            <input type="text" class="form-control" id="edit_categoryTarget" placeholder="Enter fullname">
                        </div>                                                                          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="setSubCategoriesSectionBtn">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->


        <!--Start Modal -->
        <div class="modal fade user_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Box Content</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_url" placeholder="Enter fullname">
                        </div>   
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_index" placeholder="Enter fullname">
                        </div>                                                   
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_subIndex" placeholder="Enter fullname">
                        </div>                          
                        <div class="form-group address_div">
                            <label>Sub Categories: </label>
                            <div>
                                <select name="c_stateregion" id="drop_actionTypeEdit"  class="form-control" data-status="">
                                    @foreach($childCategoryLists as $categories)
                                        <option value="{{{$categories['slug']}}}">{{{$categories["name"]}}}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="mdl_save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal -->



    <div class="modal fade" id="success" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>
                    <img src="{{{ asset('images/es_32x32.png') }}}">
                    <h3>Success</h3>        
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="customerror" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>
                    <img src="{{{ asset('images/img_alert.png') }}}">
                    <h4 id="errorTexts"></h4>        
                </div>
            </div>
        </div>
    </div>       


    <div class="modal fade user_modal" id="previewImage" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Upload Image</h4>
                </div>     

                <div class="modal-body" style='text-align:center;padding:20px;'>     
                  
                     <form id='cropForm' target="test" action="" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                        
                        <input type='hidden' name='x' value='0' id='image_x'>
                        <input type='hidden' name='y' value='0' id='image_y'>
                        <input type='hidden' name='w' value='0' id='image_w'>
                        <input type='hidden' name='h' value='0' id='image_h'>                    
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                            <div class="col-xs-10">
                                <input type="file" id="photoFile" name='myfile' class='form-control'> 
                            </div>
                        </div>                            
                        <div id="contentPreview"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="cropClose">Close</button>
                                <a1 href="#"  class="btn btn-primary text-center cropFormButton" data-dismiss="modal" data-url = "" id="">Save</a>                                       
                            </div>
                        </div>                    
                        <div id="scaleAndCrop" style="display:none;">
                            <h3>Position and scale your photo</h3><br/>
                            <div class="img-editor-container" id="imgContainer">
                                <span></span>
                                <img src=""  id="user_image_prev" style="border: black 1px solid;">
                            </div>
                        </div>   <br/>                          
                    </form> 
                </div>                            
            </div>
        </div>
    </div>      

@stop
@section('page_js') 
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/src/jquery.form.js') }}
{{ HTML::script('js/src/jquery.Jcrop.min.js') }}
{{ HTML::script('js/cms_newhome.js') }}

@stop
