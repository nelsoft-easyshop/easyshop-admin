                                        <div class="col-lg-15" style='text-align:center;' id="sliderReload_{{$sliderIndex}}">
                                            <span style="display:none;">{{$subSlideIndex=0}}</span>                      
                                            <span style="display:none;">{{$slideCount=1}}</span>  
                                            @foreach($slides as $subSlides)

                                                <div style="position:relative;display:inline-block;">
                                                    <div class='well' style="height:auto;">
                                                    <center>
                                                        <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                                                            <img src="{{$assetLink}}{{$subSlides->path}}" class="img-responsive" data-div="" style="border: black 1px solid;height: auto; max-height: 200px;"/>
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
                                                    </center>
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

                                        