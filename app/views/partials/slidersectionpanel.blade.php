                                        <div class="col-lg-15" style='text-align:center;' id="sliderReload_{{$sliderIndex}}">
                                            <span style="display:none;">{{$subSlideIndex=0}}</span>                      
                                            <span style="display:none;">{{$slideCount=1}}</span>  
                                            @foreach($slides as $subSlides)

                                                <div style="position:relative;display:inline-block;">
                                                    <div class='well' style="height:210px;">
                                                        <p>
                                                            <img src="{{$easyShopLink}}/assets//cms/home/{{$subSlides->path}}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive'/>
                                                        </p>

                                                        <a href="#myMain_{{$sliderIndex}}_{{$subSlideIndex}}" data-toggle="modal" style="position:absolute;top:180px;left:135px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
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
                                                            style="position:absolute;top:180px;left:5px;"
                                                            data-url = "{{{$newHomeCmsLink}}}/setSliderPosition"
                                                         ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                                         <a  
                                                            id="movedown" 
                                                            data-action="down" 
                                                            data-index="{{$sliderIndex}}" 
                                                            data-order="{{$subSlideIndex}}" 
                                                            data-subindex="{{$subSlideIndex}}" 
                                                            style="position:absolute;top:180px;right:5px;"
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