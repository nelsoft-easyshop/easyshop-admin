@extends('layouts.default')

@section('description', 'Mobile Content Manager - Home Page')
@section('keywords', '')
@section('title', 'Mobile Home CMS | Easyshop Admin')
@section('header_tagline', 'Mobile Content Manager - Home Page')

@section('page_header')
    @include('includes.header')
@stop

@section('content')

    <link type="text/css" href="{{{ asset('css/dashboard.css') }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/src/jquery.minicolors.css') }}}" rel="stylesheet"  media="screen"/>


   <div class="row">

        <section id="tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#manageMainSlide" role="tab" data-toggle="tab">Manage Main Slides</a></li>
                <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Manage Section Nodes<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <span style="display:none;">{{$index=0}}</span>
                        @foreach($sectionContent as $section)
                            <li class="category-section-trigger" >
                                <a href="#page_{{$index}}" tabindex="-1" role="tab" id="sectionNav_{{$index}}" data-toggle="tab">
                                    {{{ $section->categoryName }}}
                                </a>
                            </li>
                            <span style="display:none;">{{$index++}}</span>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </section>

        {{ Form::hidden('userid', $adminObject->id_admin_member, array('id' => 'userid','class' => 'form-control')) }}                        

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="manageMainSlide">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Add Main Slide</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <form id='mainSlideForm' target="test" action="{{ $mobileCmsLink}}/addMainSlide" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                                        <div class="col-xs-10">
                                            <input type="file" id="photoFile" name='myfile'> 
                                        </div>
                                    </div>
                                        <input type="text" id="valueMainSlide" class="form-control" readonly='readonly' value='Image' name='value'  placeholder="value" style="display:none;">
                                    <div class="form-group">
                                        <label for="inputPassword" class="control-label col-xs-2">Target</label>
                                        <div class="col-xs-10">
                                            <input type="text" id="mainSlideTarget" class="form-control" name='target' value="" placeholder="/someUrl" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="control-label col-xs-2">Action Types</label>
                                        <div class="col-xs-10">
                                            <select name="actionType" id="dropActionTypes"  class="form-control" data-status="">
                                                @foreach($actionTypes as $types)
                                                    <option value="{{{ $types }}}">{{{ $types }}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                    <input type="hidden" id="userIdMainSlide" class="form-control" name = 'userid' value='{{$adminObject->id_admin_member}}'  placeholder="value" >
                                    <input type="hidden" id="hashMainSlide" class="form-control" name = 'hash' value=''  placeholder="value" >
                        

                                    <div class="form-group">
                                        <div class="col-xs-offset-2 col-xs-10">
                                            <a1 href="#"  class="btn btn-default text-center"  data-url = "{{ $mobileCmsLink }}/addmainslide" id="submitAddMainSlide">Submit</a>
                                        </div>
                                    </div>
                                 </form>
                            </div>
                        </div>

                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Manage Main Slide</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in">
                            <div class="panel-body">
                            <fieldset>
                                <!-- Form Name -->
                                <div class="form-group ">
                                    <div class="col-lg-15" style='text-align:center;'>
                                         @foreach ($mainSlides as $mainSlide)
                                            <div style="position:relative;display:inline-block;">
                                            <div class='well' style="height:auto;">
                                            <div  style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                <img src="{{$assetLink}}/{{ $mainSlide->value }}" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;" class='img-responsive'/>
                                            </div>

                                            <a href="#myMain{{ $mainSlideId }}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                            <a class="btn btn-default" 
                                                id="deleteMainSlide" 
                                                data-index="{{$mainSlideId}}"  
                                                data-nodename="mainSlide" 
                                                style="position:absolute;top:2px;left:5px;"
                                                data-url = "{{ $mobileCmsLink }}/removeContent"
                                             ><font color='red'><b>X</b></font></a>

                                            <a 
                                                id="moveup" 
                                                 data-action="up" 
                                                 data-index="{{$mainSlideId}}" 
                                                 data-value="{{$mainSlide->value}}" 
                                                 data-target="{{$mainSlide->imagemap->target}}" 
                                                 data-order="{{$mainSlideId}}" 
                                                 style="position:absolute;top:235px;left:5px;"
                                                 data-url = "{{ $mobileCmsLink }}/setmainslide"
                                             ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                             <a  
                                                id="movedown" 
                                                data-action="up" 
                                                data-index="{{$mainSlideId}}" 

                                                data-value="{{$mainSlide->value}}" 
                                                data-target="{{$mainSlide->imagemap->target}}" 
                                                data-order="{{$mainSlideId}}" 
                                                data-count="{{$mainSlideCount}}" 
                                                style="position:absolute;top:235px;right:5px;"
                                                data-url = "{{ $mobileCmsLink }}/setmainslide"
                                             ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
                                             </div>
                                            <div class="modal fade" id="myMain{{ $mainSlideId }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" style='margin-top:2px;'><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Edit Main Slide</h4>
                                                            </div>
                                                        <div class="modal-body">
                                                            <form id='mainSlideForm{{$mainSlideId}}' target="test" action="{{ $mobileCmsLink}}/setmainslide" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">
                                                                {{ Form::hidden('index', $mainSlideId) }}                                                                                                                       
                                                                <div class="form-group">
                                                                    <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                                                                    <div class="col-xs-10">
                                                                        <input type="file" id="photoFile" name='myfile'> 
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword" class="control-label col-xs-2">Target</label>
                                                                    <div class="col-xs-10">
                                                                        {{ Form::text('target', $mainSlide->imagemap->target, array('id' => 'editMainSlideTarget','class' => 'form-control')) }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword" class="control-label col-xs-2">Action Type</label>
                                                                    <div class="col-xs-10">
                                                                        <select name="actionType" id="dropActionTypes"  class="form-control" data-status="">
                                                                            @foreach($actionTypes as $types)
                                                                                @if(trim((string)$mainSlide->actionType) === trim((string)$types))
                                                                                    <option value="{{{ $types }}}" selected>{{{ $types }}}</option>
                                                                                @else
                                                                                    <option value="{{{ $types }}}">{{{ $types }}}</option>                                                                            
                                                                                @endif
                                                                            @endforeach
                                                                        </select>   
                                                                    </div>
                                                                </div>                                                                
                                                                {{ Form::hidden('hash', $mainSlide->imagemap->target, array('id' => 'hashEditMainSlide','class' => 'form-control')) }}
                                                                <input type="hidden" id="useridMainSlide" class="form-control" name = 'userid' value='{{$adminObject->id_admin_member}}'  placeholder="value" >                    


                                                                <div class="form-group" >
                                                                    <div class="col-xs-10">
                                                                        <a href="" class="btn btn-primary"
                                                                         style="margin-left:100px;"
                                                                         data-index="{{$mainSlideId}}" 
                                                                         data-target="{{$mainSlide->imagemap->target}}" 
                                                                         data-order="{{$mainSlideId}}" 
                                                                         data-count="{{$mainSlideCount}}"
                                                                         data-url = "{{ $mobileCmsLink }}/setmainslide"
                                                                         data-dismiss = "modal"
                                                                         id='submit'>Submit</a>
                                                                    </div>
                                                                </div>
                                                             </form>                                                            

                                                        </div>
                                                     </div>
                                                </div>
                                              </div>
                                            </div><span style="display:none;">{{$mainSlideId++}}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </fieldset>
                            </div>
                        </div>
                        
                    </div>                    
                </div>
            </div>
            <span style="display:none;">{{$index=0}}</span>
            @foreach($sectionContent as $section)
                <div class="tab-pane fade" id="page_{{$index}}">                    
                    <form id='left' target="test"  class="form-horizontal">            
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Manage <span class="category-head-title">{{$section->name}}</span> Category Header
                            </h4>
                        </legend>                                   
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                {{ Form::hidden('index', $index, array('id' => 'index','class' => 'form-control')) }}                                 
                                <select name="c_stateregion" id="categoryName"  class="form-control" data-status="">
                                    @foreach($categoryLists as $categories)
                                        @if($categories["name"] !== "PARENT")
                                            @if((string)$categories["slug"] === (string)$section->name)
                                                <option value="{{{$categories['slug']}}}" data-catname="{{{$categories['name']}}}" selected>
                                                    {{{$categories["name"]}}} - ({{{$categories['slug']}}})
                                                </option>
                                            @else
                                                <option value="{{{$categories['slug']}}}" data-catname="{{{$categories['name']}}}">
                                                    {{{$categories["name"]}}} - ({{{$categories['slug']}}})
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>                  
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">BGColor</label>
                            <div class="col-sm-10">    
                                <input name='target' type="text" id="text-field bgcolor" class="form-control bgcolor" value="{{{  $section->bgcolor }}}">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                 <select name="c_stateregion" id="themeName"  class="form-control" data-status="">
                                    @foreach($themeLists as $theme)
                                        @if((string)$theme === (string)$section->type)
                                            <option value="{{{$theme}}}"  selected>{{{$theme}}}</option>
                                        @else
                                            <option value="{{{$theme}}}" >{{{$theme}}}</option>
                                        @endif
                                    @endforeach                                
                                </select>                    
                            </div>
                        </div>                                       
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{ $mobileCmsLink }}/setSectionHead" id="setSectionHead">Submit</a>
                            </div>
                        </div>                                      
                    </form>

                    <form class="form-horizontal mobile-home-section-form add-section">            
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Add Box Content
                            </h4>
                        </legend>                                   
                        <div class="form-group">
                            <label for="value" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                {{ Form::hidden('index', "$index", array('id' => 'index','class' => 'form-control')) }}                        
                                {{ Form::text('value', "", array('id' => 'value','class' => 'value form-control')) }}                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                {{ Form::text('Type', "product", array('id' => 'type','class' => 'form-control', 'readonly' => 'readonly')) }}                        
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="target" class="col-sm-2 control-label">Target</label>
                            <div class="col-sm-10">
                                {{ Form::text('target', "", array('id' => 'target','class' => 'target form-control')) }}                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="drop_actionType" class="col-sm-2 control-label">Action Type</label>
                            <div class="col-sm-10">
                                <select name="c_stateregion" id="drop_actionType"  class="form-control selectbox-action-type" data-status="">
                                    @foreach($actionTypes as $types)
                                        <option value="{{{ $types }}}">{{{ $types }}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                          
                                                           
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{ $mobileCmsLink }}/addBoxContent" id="addBoxContent">Add Box Content</a>
                            </div>
                        </div>                                      
                    </form>                        
                    <div class="tbl-div">                 
                    <legend>        
                        <h4 class="tbl-title">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Manage Box Content
                        </h4>
                    </legend>                                            
                        <table class="table table-striped table-hover tbl-my-style"  id="tableIndex_{{$index}}">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Slug</th>
                                <th>Type</th>
                                <th>Target</th>
                                <th>Action Type</th>

                            </tr>
                            </thead>
                            <tbody id="tbody_boxContent">
                            <span style="display:none;">{{$boxContentIndex=0}}</span>
                            @foreach($section->boxContent as $content)
                                <tr>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger edit_btn" id="data_{{$index}}_{{$boxContentIndex}}" 
                                                    data='{"tableindex":"{{{ $index }}}","url":"{{{ $mobileCmsLink }}}/setBoxContent","sectionIndex":"{{{ $index }}}","boxIndex":"{{{ $boxContentIndex}}}","value":"{{{ $content->value }}}","type":"{{{ $content->type }}}","target":"{{{ $content->target }}}","actionType":"{{{ $content->actionType }}}" } '
                                                    data-toggle="modal" data-target="#myModal" data="">
                                                    <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                                </button>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn removeButton" data-url="{{{ $mobileCmsLink }}}/removeContent" data-nodename="boxContent" data-index="{{{ $index }}}" data-subindex= "{{{ $boxContentIndex }}}" >
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                            </div>                                            
                                        </div>
                                    </td>
                                    <td id="value_{{$index}}_{{$boxContentIndex}}">{{{$content->value}}}</td>
                                    <td id="type_{{$index}}_{{$boxContentIndex}}">{{{$content->type}}}</td>
                                    <td id="target_{{$index}}_{{$boxContentIndex}}">{{{$content->target}}}</td>
                                    <td id="actionType_{{$index}}_{{$boxContentIndex}}">{{{$content->actionType}}}</td>
                                    <span style="display:none;">{{$boxContentIndex++}}</span>                            
                                    <input type="hidden" class="boxContentCount_{{$index}}" value="{{$boxContentIndex}}">
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>                
                <span style="display:none;">{{$index++}}</span>
            @endforeach
        </div>

    </div>

        <!--Start Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Box Content</h4>
                    </div>
                    <div class="modal-body mobile-home-section-form">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_url" placeholder="">
                        </div>                         
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_sectionIndex" placeholder="">
                        </div>                          
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_boxindex" placeholder="">
                        </div>                        
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="hidden" class="form-control" id="edittable_index" value="" placeholder="">
                            <input type="text" class="form-control value" id="edit_value" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" class="form-control" id="edit_type" readonly="readonly" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Target</label>
                            <textarea class="form-control target" id="edit_target" rows="3"></textarea>
                        </div>
                        <div class="form-group address_div">
                            <label>Action Type : </label>
                            <div>
                                <select name="c_stateregion" id="drop_actionTypeEdit"  class="selectbox-action-type form-control" data-status="">
                                    @foreach($actionTypes as $types)
                                        <option value="{{{ $types }}}">{{{ $types }}}</option>
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

    <input type="hidden" id="action-type-showproductdetails" 
           value="{{  strtolower(str_replace(" ", "", \Easyshop\Services\XMLContentGetterService::MOBILE_CMS_ACTIONTYPE_SHOWPRODUCTDETAILS)) }}"/>
    <input type="hidden" id="action-type-gotosite" 
           value="{{  strtolower(str_replace(" ", "", \Easyshop\Services\XMLContentGetterService::MOBILE_CMS_ACTIONTYPE_GOTOSITE)) }}"/>
    <input type="hidden" id="action-type-gotopage" 
           value="{{  strtolower(str_replace(" ", "", \Easyshop\Services\XMLContentGetterService::MOBILE_CMS_ACTIONTYPE_GOTOPAGE)) }}"/>
    <input type="hidden" id="action-type-showproductlist" 
           value="{{  strtolower(str_replace(" ", "", \Easyshop\Services\XMLContentGetterService::MOBILE_CMS_ACTIONTYPE_SHOWPRODUCTLIST)) }}"/>

@stop

@section('page_js') 
{{ HTML::script('js/src/jquery.form.js') }}
{{ HTML::script('js/src/jquery.minicolors.js') }}
{{ HTML::script('js/cms_mobile.js') }}

@stop

