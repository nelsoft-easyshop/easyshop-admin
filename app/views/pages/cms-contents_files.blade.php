  @extends('layouts.default')

@section('description', 'Content Manager - Content Files')
@section('keywords', '')
@section('title', 'Content Files CMS | Easyshop Admin')
@section('header_tagline', 'Content Manager - Content Files')


@section('page_header')
    @include('includes.header')
@stop

@section('content')


    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/homecms.css') }}}" rel="stylesheet"  media="screen"/>

   <div class="row">
        <span id="userIdSpan" style="display:none;">{{ $userId }}</span>
        <span id="adminPasswordSpan" style="display:none;">{{ $adminPassword }}</span>
    <section id="tabs">
        <ul id="myTab" class="nav nav-tabs" role="tablist">
            <li class="dropdown ">
                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Manage Feeds <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                    <li><a href="#addFeaturedProduct" tabindex="-1" role="tab" data-toggle="tab">Add Featured Product</a></li>
                    <li><a href="#addPopularItemsDiv" tabindex="-1" role="tab" data-toggle="tab">Add Popular Items</a></li>
                    <li><a href="#addfeedPromoItems" tabindex="-1" role="tab" data-toggle="tab">Add Promo Items</a></li>
                </ul>
            </li>
            <li><a href="#manageFeedBannerDiv" role="tab" data-toggle="tab">Manage Feed Banner</a></li>
            <li class="active"><a href="#manageSelectDiv" role="tab" data-toggle="tab">Manage Select Node</a></li>

        </ul>
    </section>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="manageSelectDiv">
            @foreach($selectNodes as $nodes)
                <form method="post" action="{{ $contentCmsLink }}/setFeedBanner" class='form-horizontal'>
                    <div class="form-group">

                        <label for="userId" class="col-sm-2 control-label">{{ucwords($nodes->attributes()->id)}}</label>
                        <div class="col-sm-10">
                            {{ Form::text('value', trim($nodes), array('id' => 'value','class' => 'form-control')) }}
                            {{ Form::hidden('id', $nodes->attributes()->id, array('id' => 'id')) }}    
                            {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}    
                            {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}    
                            {{ Form::hidden('hash', "", array('id' => 'hash')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div style='text-align:center;padding-top:10px;'>
                            @if($nodes->attributes()->id != "bank-account-number" && $nodes->attributes()->id != "bank-name" && $nodes->attributes()->id != "bank-account-name")
                                <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/setSelect" id="submitSelect" data-checkuser = "1">Submit</a>
                            @else
                                <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/setSelect" id="submitSelect" data-checkuser="0">Submit</a>
                            @endif                                    
                        </div>
                    </div>
                </form> 
            @endforeach                       
        </div>
        <div class="tab-pane fade" id="manageFeedBannerDiv">

        <form id='left' target="test" action="{{ $contentCmsLink}}/setfeedbanner" class="form-horizontal" method="post" enctype="multipart/form-data">            
            <legend>Left Feed Banner</legend>                                   
            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                <div class="col-xs-10">
                    <input type="file" id="photoFile" name='myfile'> 

                    {{ Form::hidden('choice', "left", array('id' => 'choice')) }}    
                    {{ Form::hidden('userid', "$userId", array('id' => 'userid')) }}    
                    {{ Form::hidden('hash', "", array('id' => 'hashleft')) }}
                
                </div>
            </div>
            <div class="form-group">
                <label for="userId" class="col-sm-2 control-label">Target</label>
                <div class="col-sm-10">
                    {{ Form::text('target', "$leftBannerTarget", array('id' => 'target','class' => 'form-control')) }}                        
                    {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}                        
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/setFeedBanner" id="submitFeedBanner">Submit</a>
                </div>
            </div>
        </form>

        <form id='mid' target="test" action="{{ $contentCmsLink}}/setfeedbanner" class="form-horizontal" method="post" enctype="multipart/form-data">            
            <legend>Middle Feed Banner</legend>            

            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                <div class="col-xs-10">
                    <input type="file" id="photoFile" name='myfile'> 

                    {{ Form::hidden('choice', "mid", array('id' => 'choice')) }}    
                    {{ Form::hidden('userid', "$userId", array('id' => 'userid')) }}    
                    {{ Form::hidden('hash', "", array('id' => 'hashmid')) }}
                
                </div>
            </div>
            <div class="form-group">
                <label for="userId" class="col-sm-2 control-label">Target</label>
                <div class="col-sm-10">
                    {{ Form::text('target', "$midBannerTarget", array('id' => 'target','class' => 'form-control')) }}                        
                    {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}                        
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/setFeedBanner" id="submitFeedBanner">Submit</a>
                </div>
            </div>
        </form>

        <form id='right' target="test" action="{{ $contentCmsLink}}/setfeedbanner" class="form-horizontal" method="post" enctype="multipart/form-data">            
            <legend>Right Feed Banner</legend>                                   
            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                <div class="col-xs-10">
                    <input type="file" id="photoFile" name='myfile'> 

                    {{ Form::hidden('choice', "right", array('id' => 'choice')) }}    
                    {{ Form::hidden('userid', "$userId", array('id' => 'userid')) }}    
                    {{ Form::hidden('hash', "", array('id' => 'hashright')) }}
                
                </div>
            </div>
            <div class="form-group">
                <label for="userId" class="col-sm-2 control-label">Target</label>
                <div class="col-sm-10">
                    {{ Form::text('target', "$rightBannerTarget", array('id' => 'target','class' => 'form-control')) }}                        
                    {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}                        
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/setFeedBanner" id="submitFeedBanner">Submit</a>
                </div>
            </div>
         </form>
        </div>

        <div class="tab-pane fade" id="addFeaturedProduct">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                            Add Featured Product
                        </a>
                    </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form method="post" action="$contentCmsLink/addfeedFeaturedProduct" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                <fieldset>
                                    <!-- Form Name -->
                                    <div class="form-group ">
                                        <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                        <div class="col-sm-10">
                                            {{ Form::text('featuredProduct', "" ,array('id' => 'featuredProduct','class' => 'form-control')) }}
                                            {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                            {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                            {{ Form::hidden('hash', "", array('id' => 'hash')) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div style='text-align:center;padding-top:10px;'>
                                        <br/>
                                        <a  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/addfeedFeaturedProduct" id="addFeaturedProductBtn"
                                            >Submit</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                                Manage Featured Product
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class='row'>
                                @foreach($feedFeaturedProduct as $products)
                                    <div class='col-md-4'>
                                        <div class='well' >                                                                                   
                                            <a id="moveDownFeaturedProduct"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$featuredProductCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedFeaturedProduct"
                                            >
                                                <span class="glyphicon glyphicon-chevron-right pull-right" style='font-size:16px;'></span>
                                            </a>

                                            <a id="moveUpFeaturedProduct"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$featuredProductCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedFeaturedProduct"
                                            >
                                                <span class="glyphicon glyphicon-chevron-left pull-left" style='font-size:16px;'></span>
                                            </a>
                                           
                                            <center>
                                                <span>{{$products->slug}}</span><br/><br/>
                                                <a href='#modalFeatured{{$indexForEach}}' data-toggle="modal">
                                                    <span class="glyphicon glyphicon-edit" style='font-size:16px;'></span>
                                                </a>
                                                <a 
                                                    id="productslide" 
                                                    data-index="{{$indexForEach}}"  
                                                    data-nodename="//feedFeaturedProduct" 
                                                    data-userid="{{$userId}}"                                                
                                                    data-password="{{$adminPassword}}"
                                                    data-url = "{{ $contentCmsLink }}/removeContent"
                                                 >
                                                    <span class="glyphicon glyphicon-remove" style='font-size:16px;'></span>

                                                </a>                                                 
                                            </center>
                                        </div>                                            
                                    </div>

                                    <div class="modal fade" id="modalFeatured{{$indexForEach}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h4>Edit Featured Product</h4>
                                                    </div>
                                                <div class="modal-body">
                                                    <form method="post" action="$contentCmsLink/addfeedFeaturedProduct" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                                        <fieldset>
                                                            <!-- Form Name -->
                                                            <div class="form-group ">
                                                                <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                                                <div class="col-sm-10">
                                                                    {{ Form::text('featuredProduct', "$products->slug" ,array('id' => 'featuredProduct','class' => 'form-control')) }}
                                                                    {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                                                    {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div style='text-align:center;padding-top:10px;'>
                                                                <br/>
                                                                <a href="#" data-index="{{$indexForEach}}" data-order="{{$indexForEach}}" data-dismiss = "modal" class="btn btn-primary"  data-url = "{{ $contentCmsLink }}/setfeedFeaturedProduct" id="submitFeaturedProductBtn"
                                                                    >Submit</a>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                <span style="display:none;">{{ $indexForEach++ }}</span>
                                @endforeach
                                <span style="display:none;">{{ $indexForEach=0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="addPopularItemsDiv">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                            Add Popular Items
                        </a>
                    </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form method="post" action="$contentCmsLink/addfeedPopularItems" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                <fieldset>
                                    <!-- Form Name -->
                                    <div class="form-group ">
                                        <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                        <div class="col-sm-10">
                                            {{ Form::text('popularItem', "" ,array('id' => 'popularItem','class' => 'form-control')) }}
                                            {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                            {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                            {{ Form::hidden('hash', "", array('id' => 'hash')) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div style='text-align:center;padding-top:10px;'>
                                        <br/>
                                        <a  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/addfeedPopularItems" id="addPopularItemBtn"
                                            >Submit</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                                Manage Popular Items
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class='row'>
                                @foreach($feedPopularItems as $products)
                                    <div class='col-md-4'>
                                        <div class='well' >
                                            <a id="moveDownPopularItems"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$popularItemsCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedPopularItems"
                                            >
                                                <span class="glyphicon glyphicon-chevron-right pull-right" style='font-size:16px;'></span>
                                            </a>

                                            <a id="moveUpPopularItems"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$popularItemsCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedPopularItems"
                                            >
                                                <span class="glyphicon glyphicon-chevron-left pull-left" style='font-size:16px;'></span>
                                            </a>
                                           
                                            <center>
                                                <span>{{$products->slug}}</span><br/><br/>
                                                <a href='#modalPopular{{$indexForEach}}' data-toggle="modal">
                                                    <span class="glyphicon glyphicon-edit" style='font-size:16px;'></span>
                                                </a>
                                                <a 
                                                    id="productslide" 
                                                    data-index="{{$indexForEach}}"  
                                                    data-nodename="//feedPopularItems" 
                                                    data-userid="{{$userId}}"                                                
                                                    data-password="{{$adminPassword}}"
                                                    data-url = "{{ $contentCmsLink }}/removeContent"
                                                 >
                                                    <span class="glyphicon glyphicon-remove" style='font-size:16px;'></span>

                                                </a>                                                 
                                            </center>
                                        </div>                                            
                                    </div>

                                    <div class="modal fade" id="modalPopular{{$indexForEach}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h4>Edit Popular Item</h4>
                                                    </div>
                                                <div class="modal-body">
                                                    <form method="post" action="$contentCmsLink/addfeedFeaturedProduct" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                                        <fieldset>
                                                            <!-- Form Name -->
                                                            <div class="form-group ">
                                                                <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                                                <div class="col-sm-10">
                                                                    {{ Form::text('popularItem', "$products->slug" ,array('id' => 'popularItem','class' => 'form-control')) }}
                                                                    {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                                                    {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div style='text-align:center;padding-top:10px;'>
                                                                <br/>
                                                                <a href="#" data-index="{{$indexForEach}}" data-order="{{$indexForEach}}" data-dismiss = "modal" class="btn btn-primary"  data-url = "{{ $contentCmsLink }}/setfeedPopularItems" id="submitPopularItemBtn"
                                                                    >Submit</a>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                <span style="display:none;">{{ $indexForEach++ }}</span>
                                @endforeach
                                <span style="display:none;">{{ $indexForEach=0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="addfeedPromoItems">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                            Add Promo Items
                        </a>
                    </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form method="post" action="$contentCmsLink/addfeedPromoItems" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                <fieldset>
                                    <!-- Form Name -->
                                    <div class="form-group ">
                                        <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                        <div class="col-sm-10">
                                            {{ Form::text('promoItem', "" ,array('id' => 'promoItem','class' => 'form-control')) }}
                                            {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                            {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                            {{ Form::hidden('hash', "", array('id' => 'hash')) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div style='text-align:center;padding-top:10px;'>
                                        <br/>
                                        <a  class="btn btn-default text-center" data-url = "{{ $contentCmsLink }}/addfeedPromoItems" id="addPromoItemBtn"
                                            >Submit</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                <span style="display:none;">{{ $collapse++ }}</span>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$collapse}}">
                                Manage Promo Items
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$collapse}}" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class='row'>
                                @foreach($feedPromoItems as $products)
                                    <div class='col-md-4'>
                                        <div class='well' >
                                            <a id="moveDownPromoItems"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$promoItemsCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedPromoItems"
                                            >
                                                <span class="glyphicon glyphicon-chevron-right pull-right" style='font-size:16px;'></span>
                                            </a>

                                            <a id="moveUpPromoItems"
                                                data-action="up" 
                                                data-index="{{$indexForEach}}" 
                                                data-userid="{{$userId}}" 
                                                data-value="{{$products->slug}}" 
                                                data-order="{{$indexForEach}}" 
                                                data-count="{{$promoItemsCount}}" 
                                                data-password="{{$adminPassword}}"
                                                data-url = "{{ $contentCmsLink }}/setfeedPromoItems"
                                            >
                                                <span class="glyphicon glyphicon-chevron-left pull-left" style='font-size:16px;'></span>
                                            </a>
                                           
                                            <center>
                                                <span>{{$products->slug}}</span><br/><br/>
                                                <a href='#modalPromo{{$indexForEach}}' data-toggle="modal">
                                                    <span class="glyphicon glyphicon-edit" style='font-size:16px;'></span>
                                                </a>
                                                <a 
                                                    id="productslide" 
                                                    data-index="{{$indexForEach}}"  
                                                    data-nodename="//feedPromoItems" 
                                                    data-userid="{{$userId}}"                                                
                                                    data-password="{{$adminPassword}}"
                                                    data-url = "{{ $contentCmsLink }}/removeContent"
                                                 >
                                                    <span class="glyphicon glyphicon-remove" style='font-size:16px;'></span>

                                                </a>                                                 
                                            </center>
                                        </div>                                            
                                    </div>

                                    <div class="modal fade" id="modalPromo{{$indexForEach}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h4>Edit Promo Item</h4>
                                                    </div>
                                                <div class="modal-body">
                                                    <form method="post" action="$contentCmsLink/addfeedPromoItems" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">     
                                                        <fieldset>
                                                            <!-- Form Name -->
                                                            <div class="form-group ">
                                                                <label for="userId" class="col-sm-2 control-label">Product Slug</label>
                                                                <div class="col-sm-10">
                                                                    {{ Form::text('promoItem', "$products->slug" ,array('id' => 'promoItem','class' => 'form-control')) }}
                                                                    {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                                                    {{ Form::hidden('userId', "$userId", array('id' => 'userId')) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div style='text-align:center;padding-top:10px;'>
                                                                <br/>
                                                                <a href="#" data-index="{{$indexForEach}}" data-order="{{$indexForEach}}" data-dismiss = "modal" class="btn btn-primary"  data-url = "{{ $contentCmsLink }}/setfeedPromoItems" id="submitPromoItemBtn"
                                                                    >Submit</a>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                <span style="display:none;">{{ $indexForEach++ }}</span>
                                @endforeach
                                <span style="display:none;">{{ $indexForEach=0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

    <div class="modal fade" id="loading" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;`'>
                    <img src="{{{ asset('images/orange_loader.gif') }}}">
                    <h3>Please Wait..</h3>        
                </div>
            </div>
        </div>
    </div>
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
    <div class="modal fade" id="error" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>
                    <img src="{{{ asset('images/img_alert.png') }}}">
                    <h3>Please try again</h3>        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="customerror" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style='text-align:center;'>
                    <img src="{{{ asset('images/img_alert.png') }}}">
                    <h3 id="errorTexts">Product slug does not exist</h3>        
                </div>
            </div>
        </div>
    </div>    
    </div>

@stop
@section('page_js') 
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/cms.js') }}
{{ HTML::script('js/src/jquery.form.js') }}

@stop

