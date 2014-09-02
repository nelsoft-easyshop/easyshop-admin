  <script type="text/javascript">
      $(document).ready(function(){

        $("#loading").modal('hide');
        $("#success").modal('show');
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
                                <input type="file" id="exampleInputFile" name='myfile'> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Value</label>
                            <div class="col-xs-10">
                                <input type="text" id="valueMainSlide" class="form-control" name='value' readonly="readonly" value="value" placeholder="Value" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Coordinate</label>
                            <div class="col-xs-10">
                                <input type="text" id="mainSlideCoordinate" class="form-control" name='coordinate' value="0,0,589,352" placeholder="0,0,0,0" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Target</label>
                            <div class="col-xs-10">
                                <input type="text" id="mainSlideTarget" class="form-control" name='target'  placeholder="Value" >
                            </div>
                        </div>
            
                        <input type="hidden" id="userIdMainSlide" class="form-control" name = 'userid' value='{{$userId}}'  placeholder="Value" >
                        <input type="hidden" id="adminPasswordMainSlide" class="form-control" name="password" value='{{$adminPassword}}'  placeholder="Value" >
                        <input type="hidden" id="hashMainSlide" class="form-control" name = 'hash' value=''  placeholder="Value" >
                      

                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                    <a1 href="#"  class="btn btn-default text-center" data-url = "{{ $homeCmsLink }}/addmainslide" id="submitAddMainSlide">Submit</a>
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
                              <div style="position:relative;
                                  display:inline-block;">
                              <p><img src="{{$easyShopLink}}/{{ $mainSlide->value }}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive'></p>

                              <a href="#myMain{{ $mainSlideId }}" data-toggle="modal" class="btn btn-default" style="position:absolute;top:110px;left:105px;">Edit</a>
                               
                              <a href="#"  class="btn btn-default" 
                              id="moveup" 
                               data-action="up" 
                               data-index="{{$mainSlideId}}" 
                               data-userid="{{$userId}}" 
                               data-value="{{$mainSlide->value}}" 
                               data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
                               data-target="{{$mainSlide->imagemap->target}}" 
                               data-order="{{$mainSlideId}}" 
                               data-password="{{$adminPassword}}"
                               style="position:absolute;top:110px;left:5px;"
                               data-url = "{{ $homeCmsLink }}/setmainslide"
                               ><<</a>

                               <a href="#"  class="btn btn-default" 
                              id="movedown" 
                              data-action="up" 
                              data-index="{{$mainSlideId}}" 
                              data-userid="{{$userId}}" 
                              data-value="{{$mainSlide->value}}" 
                              data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
                              data-target="{{$mainSlide->imagemap->target}}" 
                              data-order="{{$mainSlideId}}" 
                              data-count="{{$mainSlideCount}}" 
                              data-password="{{$adminPassword}}"
                              data-url = "{{ $homeCmsLink }}/setmainslide"

                              style="position:absolute;top:110px;right:5px;"
                               >>></a>


                                  <div class="modal fade" id="myMain{{ $mainSlideId }}" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4>Edit Main Slide</h4>
                                          </div>
                                          <div class="modal-body">
                     <form id='mainSlideForm' target="test" action="{{ $homeCmsLink}}/addmainslide" class="form-horizontal" method="post" enctype="multipart/form-data">

                        <fieldset>
                        <!-- Form Name -->
                        {{ Form::hidden('index', $mainSlideId) }}
                        {{ Form::hidden('userid', $userId) }}
                        {{ Form::hidden('value', "$mainSlide->value", array('id' => 'mainSlideImage','class' => 'form-control')) }}
                                          <div class="form-group ">
                                              <label for="userId" class="col-sm-2 control-label">Value</label>
                                              <div class="col-sm-10">
                                                  {{ Form::text('coordinate', $mainSlide->value, array('id' => 'mainSlideValue','class' => 'form-control')) }}
                                              </div>
                                              <label for="userId" class="col-sm-2 control-label">Coordinate</label>
                                              <div class="col-sm-10">
                                                  {{ Form::text('coordinate', $mainSlide->imagemap->coordinate, array('id' => 'mainSlideCoordinate','class' => 'form-control')) }}
                                              </div>
                                               <label for="userId" class="col-sm-2 control-label">Target</label>
                                              <div class="col-sm-10">
                                                  {{ Form::text('target', $mainSlide->imagemap->target, array('id' => 'mainSlideTarget','class' => 'form-control')) }}
                                              </div>
                                          </div>
                        </fieldset>
                            <a href="" class="btn btn-primary"
                             data-index="{{$mainSlideId}}" 
                             data-userid="{{$userId}}" 
                             data-value="{{$mainSlide->value}}" 
                             data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
                             data-target="{{$mainSlide->imagemap->target}}" 
                             data-order="{{$mainSlideId}}" 
                             data-count="{{$mainSlideCount}}"
                             data-password="{{$adminPassword}}"
                             data-url = "{{ $homeCmsLink }}/setmainslide"

                             data-dismiss = "modal" id='submit'>Submit</a>
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
