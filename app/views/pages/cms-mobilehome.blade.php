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


   <div class="row">
        <section id="tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#manageMainSlide" role="tab" data-toggle="tab">Manage Box Content</a></li>
                <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Manage Section Nodes<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                        <span style="display:none;">{{$index=0}}</span>
                        @foreach($sectionContent as $section)
                            <li><a href="#page_{{$index}}" tabindex="-1" role="tab" data-toggle="tab">{{{$section->name}}}</a></li>

                            <span style="display:none;">{{$index++}}</span>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </section>

        {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
        {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}    

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="manageMainSlide">
                    Test
            </div>
            <span style="display:none;">{{$index=0}}</span>
            @foreach($sectionContent as $section)
                <div class="tab-pane fade" id="page_{{$index}}">                    
                    <form id='left' target="test"  class="form-horizontal">            
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Manage {{{$section->name}}} Head
                            </h4>
                        </legend>                                   
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('target', $section->name, array('id' => 'target','class' => 'form-control')) }}                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">BGColor</label>
                            <div class="col-sm-10">
                                {{ Form::text('target', $section->bgcolor, array('id' => 'target','class' => 'form-control')) }}                        
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                {{ Form::text('target', $section->type, array('id' => 'target','class' => 'form-control')) }}                        
                            </div>
                        </div>                                       
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{ $mobileCmsLink }}/setFeedBanner" id="submitFeedBanner">Submit</a>
                            </div>
                        </div>                                      
                    </form>

                    <form id='left' target="test"  class="form-horizontal">            
                        <legend>        
                            <h4 class="tbl-title">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Add Box Content
                            </h4>
                        </legend>                                   
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Value</label>
                            <div class="col-sm-10">
                                {{ Form::hidden('index', "$index", array('id' => 'index','class' => 'form-control')) }}                        
                                {{ Form::text('value', "", array('id' => 'value','class' => 'form-control')) }}                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                {{ Form::text('Type', "", array('id' => 'type','class' => 'form-control')) }}                        
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Target</label>
                            <div class="col-sm-10">
                                {{ Form::text('target', "", array('id' => 'target','class' => 'form-control')) }}                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userId" class="col-sm-2 control-label">Action Type</label>
                            <div class="col-sm-10">
                                <select name="c_stateregion" id="drop_actionType"  class="form-control" data-status="">
                                    <option value="show product details">show product details</option>
                                    <option value="go to site">go to site</option>
                                    <option value="go to page">go to page</option>

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
                        <table class="table table-striped table-hover tbl-my-style"  id="tableme_{{$index}}">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Value</th>
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
                                                    data='{"url":"{{{ $mobileCmsLink }}}/setBoxContent","sectionIndex":"{{{ $index }}}","boxIndex":"{{{ $boxContentIndex}}}","value":"{{{ $content->value }}}","type":"{{{ $content->type }}}","target":"{{{ $content->target }}}","actionType":"{{{ $content->actionType }}}" } '
                                                    data-toggle="modal" data-target="#myModal" data="">
                                                    <span class="glyphicon-center glyphicon glyphicon-cog"></span>
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

                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                
                <span style="display:none;">{{$index++}}</span>
            @endforeach

            <div class="tab-pane fade" id="profile">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>
            <div class="tab-pane fade" id="dropdown1">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
            </div>
            <div class="tab-pane fade" id="dropdown2">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
            </div>
        </div>


    </div>

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
                            <input type="hidden" class="form-control" id="edit_sectionIndex" placeholder="Enter fullname">
                        </div>                          
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="edit_boxindex" placeholder="Enter fullname">
                        </div>                        
                        <div class="form-group">
                            <label>Value</label>
                            <input type="text" class="form-control" id="edit_value" placeholder="Enter fullname">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" class="form-control" id="edit_type" placeholder="Enter contact number">
                        </div>
                        <div class="form-group">
                            <label>Target</label>
                            <textarea class="form-control" id="edit_target" rows="3"></textarea>
                        </div>
                        <div class="form-group address_div">
                            <label>Action Type : </label>
                            <div>
                                <select name="c_stateregion" id="drop_actionTypeEdit"  class="form-control" data-status="">
                                    <option value="show product details">show product details</option>
                                    <option value="go to site">go to site</option>
                                    <option value="go to page">go to page</option>

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



@stop
@section('page_js') 
{{ HTML::script('js/src/sha1.js') }}
{{ HTML::script('js/cms_mobile.js') }}
{{ HTML::script('js/src/jquery.form.js') }}

@stop

