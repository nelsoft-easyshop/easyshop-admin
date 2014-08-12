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

                  <form id='mainSlideForm' action="https://easyshop.ph.feature/webservice/homewebservice/addmainslide" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Choose File</label>
                            <div class="col-xs-10">
                                <input type="file" id="exampleInputFile" name='myfile'> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Value</label>
                            <div class="col-xs-10">
                                <input type="text" id="value" class="form-control" name='value'  placeholder="Value" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Coordinate</label>
                            <div class="col-xs-10">
                                <input type="text" id="value" class="form-control" name='coordinate'  placeholder="0,0,0,0" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="control-label col-xs-2">Target</label>
                            <div class="col-xs-10">
                                <input type="text" id="value" class="form-control" name='target'  placeholder="Value" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                               <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Manage Main Slide
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">

                  <fieldset>
                      <!-- Form Name -->
                      <div class="form-group ">
                      
                          <div class="col-lg-15" style='text-align:center;'>
                               @foreach ($mainSlides as $mainSlide)
                              <div style="position:relative;
                                  display:inline-block;">
                              <p><img src="https://easyshop.ph.feature/{{ $mainSlide->value }}" data-div="" width="250px" height="100px" class='img-responsive'></p>

                              <a href="#myMain{{ $mainSlideId }}" data-toggle="modal" class="btn btn-default" style="position:absolute;top:110px;left:105px;">Edit</a>
                               
                               <a href="#"  class="btn btn-default" id="moveup" 
                               data-action="up" 
                               data-index="{{$mainSlideId}}" 
                               data-userid="{{$userId}}" 
                               data-value="{{$mainSlide->value}}" 
                               data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
                               data-target="{{$mainSlide->imagemap->target}}" 
                               data-order="{{$mainSlideId}}" 


                               style="position:absolute;top:110px;left:5px;"><<</a>

                                <a href="#"  class="btn btn-default" id="movedown" 
                               data-action="up" 
                               data-index="{{$mainSlideId}}" 
                               data-userid="{{$userId}}" 
                               data-value="{{$mainSlide->value}}" 
                               data-coordinate="{{$mainSlide->imagemap->coordinate}}" 
                               data-target="{{$mainSlide->imagemap->target}}" 
                               data-order="{{$mainSlideId}}" 
                               data-count="{{$mainSlideCount}}" 


                               style="position:absolute;top:110px;right:5px;">>></a>


                                  <div class="modal fade" id="myMain{{ $mainSlideId }}" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <p>Contact Form</p>
                                          </div>
                                          <div class="modal-body">
                                             <form method="post" id='mainSlideForm' data-div='1' action="https://easyshop.ph.feature/webservice/homewebservice/addmainslide" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">       

                                              <fieldset>
                                                  <!-- Form Name -->
                                                  {{ Form::hidden('index', $mainSlideId) }}
                                                  {{ Form::hidden('userid', $userId) }}
                                                  {{ Form::hidden('value', "$mainSlide->value", array('id' => 'mainSlideImage','class' => 'form-control')) }}
                                                  <div class="form-group ">
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


  