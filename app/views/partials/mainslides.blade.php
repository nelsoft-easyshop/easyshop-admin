  <script type="text/javascript">
      $(document).ready(function(){

        $("#loading").modal('hide');

      });

  </script>       

  <div class="tab-pane fade active in" id="mainSlide" onload = "success()">
          
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Add Main Slide
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">

              <form id='mainSlideForm' target="test" action="{{ $homeCmsLink}}/addmainslide" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                  <div class="col-xs-10">
                    <input type="file" id="photoFile" name='myfile'> 
                  </div>
                </div>
                    <input type="text" id="valueMainSlide" class="form-control" readonly='readonly' value='Image' name='value'  placeholder="Value" style="display:none;"/>

                <div class="form-group">
                  <label for="inputPassword" class="control-label col-xs-2">Target</label>
                  <div class="col-xs-10">
                    <input type="text" id="mainSlideTarget" class="form-control" name='target'  placeholder="Value" >
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
                <input type="hidden" id="userIdMainSlide" class="form-control" name = 'userid' value='{{$adminObject->id_admin_member}}'  placeholder="Value" >
                <input type="hidden" id="hashMainSlide" class="form-control" name = 'hash' value=''  placeholder="Value" >
          

                <div class="form-group">
                  <div class="col-xs-offset-2 col-xs-10">
                    <a1 href="#"  class="btn btn-default text-center" data-password = "{{$adminObject->password}}" data-url = "{{ $homeCmsLink }}/addmainslide" id="submitAddMainSlide">Submit</a>
                  </div>
                </div>
               </form>

                </div>
              </div>
            </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
              Manage Main Slide
              </a>
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
                      <div style="width: 200px; height: 220px;max-width: 200px; max-height: 250px; display: table-cell; vertical-align: middle;">
                        <img src="{{$easyShopLink}}/{{ $mainSlide->value }}" data-div="" style="border: black 1px solid; width: 100%; height: auto; max-height: 200px;" class='img-responsive'/>
                      </div>

                      <a href="#myMain{{ $mainSlideId }}" data-toggle="modal" style="position:absolute;top:235px;left:112px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                      <a class="btn btn-default" 
                        id="deleteMainSlide" 
                        data-index="{{$mainSlideId}}"  
                        data-nodename="mainSlide" 
                        style="position:absolute;top:2px;left:5px;"
                        data-url = "{{ $homeCmsLink }}/removeContent"
                       ><font color='red'><b>X</b></font></a>

                      <a 
                        id="moveup" 
                         data-action="up" 
                         data-index="{{$mainSlideId}}" 
                         data-value="{{$mainSlide->value}}" 
                         data-target="{{$mainSlide->imagemap->target}}" 
                         data-order="{{$mainSlideId}}" 
                         style="position:absolute;top:235px;left:5px;"
                         data-url = "{{ $homeCmsLink }}/setmainslide"
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
                        data-url = "{{ $homeCmsLink }}/setmainslide"
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
                              <form id='mainSlideForm{{$mainSlideId}}' target="test" action="{{ $homeCmsLink}}/addmainslide" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                                @if((string)$mainSlide->actionType === (string)$types)
                                                    <option value="{{{ $types }}}" selected>{{{ $types }}}</option>
                                                @else
                                                    <option value="{{{ $types }}}">{{{ $types }}}</option>                                                                            
                                                @endif
                                            @endforeach
                                        </select>   
                                    </div>
                                </div>                                
                                {{ Form::hidden('hash', $mainSlide->imagemap->target, array('id' => 'hashEditMainSlide','class' => 'form-control')) }}
                                <input type="hidden" id="useridMainSlide" class="form-control" name = 'userid' value='{{$adminObject->id_admin_member}}'  placeholder="Value" >                    

                                <div class="form-group" >
                                    <div class="col-xs-10">
                                        <a href="" class="btn btn-primary"
                                         style="margin-left:100px;"
                                         data-index="{{$mainSlideId}}" 
                                         data-target="{{$mainSlide->imagemap->target}}" 
                                         data-order="{{$mainSlideId}}" 
                                         data-count="{{$mainSlideCount}}"
                                         data-url = "{{ $homeCmsLink }}/setmainslide"
                                         data-dismiss="modal"
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
