
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
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$sliderIndex}}">Add Main Slide</a>
                                    <span class="glyphicon glyphicon-remove pull-right" id="removeMainSlider" data-nodename="mainSliderSection" data-index="{{$sliderIndex}}" data-url="{{$newHomeCmsLink}}/removeContent" style='cursor:pointer;'></span>
                                    <span class="glyphicon glyphicon-chevron-up pull-right" id="moveParentSlider" data-nodename="mainSliderSection" data-action="up" data-index="{{$sliderIndex}}" data-url="{{$newHomeCmsLink}}/setPositionParentSlider" style='cursor:pointer;'></span>
                                    <span class="glyphicon glyphicon-chevron-down pull-right" id="moveParentSlider" data-nodename="mainSliderSection" data-action="down" data-index="{{$sliderIndex}}" data-url="{{$newHomeCmsLink}}/setPositionParentSlider" style='cursor:pointer;'></span>
                                </h4>                               
                            </div>
                            <div id="collapse_{{$sliderIndex}}" class="panel-collapse collapse">
                                <div class="panel-body"> 
                                    <!-- Add Main Slide Start -->
                                    <form id='left' target="test"  class="form-horizontal">                                           
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
                                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addSubCategories" data-subcategories = "#subcategories_test" id="addSubCategoryNavigation">Set Slider Design Template</a>
                                            </div>
                                        </div>  
                                    </form>
                                    <!-- Add Main Slide End -->
                                    <!-- Add Sub Slider Start -->
                                    <legend>        
                                        <h4 class="tbl-title">
                                            <span class="glyphicon glyphicon-list-alt"></span>
                                            Add Sub Slider Section
                                        </h4>
                                    </legend>                                     
                                     <form id='mainSlideForm{{$sliderIndex}}' target="test" action="{{ $newHomeCmsLink}}/addmainslide" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                {{ Form::hidden('index', $sliderIndex, array('id' => 'index','class' => 'form-control')) }}                        
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                                            <div class="col-xs-10">
                                                <input type="file" id="photoFile" name='myfile'> 
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label for="inputPassword" class="control-label col-xs-2">Target</label>

                                            <div class="col-sm-10">
                                                {{ Form::text('target', "", array('id' => 'target','class' => 'form-control')) }}                        
                                            </div>
                                        </div>                                                                               
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                                            </div>
                                        </div>                                          
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                {{ Form::hidden('hash', "", array('id' => "hashMainSlide",'class' => 'form-control')) }}                        
                                            </div>
                                        </div>                                                                                               
                                        <div class="form-group">
                                            <div class="col-xs-offset-2 col-xs-10">
                                                <a1 href="#"  class="btn btn-primary text-center" data-url = "{{{$newHomeCmsLink}}}/addSubSlider" id="addSubSlider">Add Sub Slider</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Sub Slider Start -->

                                    <hr/>
                                    <div class="form-group ">
                                        <legend>        
                                            <h4 class="tbl-title">
                                                <span class="glyphicon glyphicon-list-alt"></span>
                                                Manage Sub Slider
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

                                                        <a href="#myMain_{{$sliderIndex}}_{{$subSlideIndex}}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
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
                                                                    <form id='editSlideForm_{{$sliderIndex}}_{{$subSlideIndex}}' target="test" action="{{ $newHomeCmsLink}}/editSubSlider" class="form-horizontal submit-test" method="post" enctype="multipart/form-data">                                        

                                                                        <div class="form-group">
                                                                            <div class="col-sm-10">
                                                                                {{ Form::hidden('index', $sliderIndex, array('id' => 'index','class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <div class="col-sm-10">
                                                                                {{ Form::hidden('subIndex', $subSlideIndex, array('id' => 'subIndex','class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div>                                                                         
                                                                        <div class="form-group">
                                                                            <div class="col-sm-10">
                                                                                {{ Form::hidden('userid', $userid, array('id' => 'userid','class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div>  
                                                                        <div class="form-group">
                                                                            <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                                                                            <div class="col-xs-10">
                                                                                <input type="file" id="photoFile" name='myfile'> 
                                                                            </div>
                                                                        </div>  
                                                                        <div class="form-group">
                                                                            <label for="inputPassword" class="control-label col-xs-2">Target</label>

                                                                            <div class="col-sm-10">
                                                                                {{ Form::text('target', $subSlides->target, array('id' => 'target','class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div>                                                                               
                                                                        <div class="form-group">
                                                                            <div class="col-sm-10">
                                                                                {{ Form::hidden('password', $password, array('id' => 'password','class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div>                                          
                                                                        <div class="form-group">
                                                                            <div class="col-sm-10">
                                                                                {{ Form::hidden('hash', "", array('id' => "editHashMainSlide",'class' => 'form-control')) }}                        
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/editSubSlider" id="editSubSlider">Add Sub Slider</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End Edit Slide Modal -->

                                                <span style="display:none;">{{$subSlideIndex++}}</span>  
                                                <span style="display:none;">{{$slideCount++}}</span>
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

                               
 