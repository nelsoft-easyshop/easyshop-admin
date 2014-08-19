       <script type="text/javascript">
      $(document).ready(function(){

        $("#loading").modal('hide');
        $("#success").modal('show');
      });

  </script>       
     <div class="tab-pane fade active in" id="productSlide" onload = "success">
    
        <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Add Product Slide
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">

              <form action="https://easyshop.ph.feature/webservice/homewebservice/addproductslide" id="addProductForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputPassword" class="control-label col-xs-2">Value</label>
                  <div class="col-xs-10">

                    <input type="text" id="valueProductSlide" class="form-control" name='value'  placeholder="Value" >
                    <input type="hidden" id="userIdProductSlide" class="form-control" name = 'userid' value='{{$userId}}'  placeholder="Value" >
                    <input type="hidden" id="adminPasswordProductSlide" class="form-control" name="password" value='{{$adminPassword}}'  placeholder="Value" >
                    <input type="hidden" id="hashProductSlide" class="form-control" name = 'hash' value=''  placeholder="Value" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-offset-2 col-xs-10">
                    <button type="submit" id='submitAddProduct' class="btn btn-default">Submit</button>
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
          Manage Product Slie
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in">
      <div class="panel-body">

              <div class="form-group ">
              
                <div class="col-lg-15" style='text-align:center'>
                  <?php 
                    $productSlide = json_decode($productSlide, TRUE); 
                    $productTypes = json_decode($productTypes, TRUE); 
                  ?>  

                  @for($i=0; $i < count($productSlide) ; $i++)
                    @for($y=0;$y < 1;$y++)
      
                      <div style="position:relative; display:inline-block;">
                          <p><img src="https://www.easyshop.ph/{{$productSlide[$i][$y]['product_image_path']}}" data-div="" width="250px" height="100px" class='img-responsive' ></p>

                           <a href="#"  class="btn btn-default" id="moveUpProductSlide" 
                            data-index='{{$i}}'
                            data-password = '{{ $adminPassword }}'
                            data-userid="{{$userId}}" 
                            data-order='{{$i}}'
                            data-count="{{$productSlideCount}}" 
                            data-value="{{$productTypes[$i]['value']}}" 
                            data-type="{{$productTypes[$i]['type']}}" 
                            data-url = "{{ $homeCmsLink }}/setproductslide"



                           style="position:absolute;top:110px;left:5px;"><<</a>
                              <button class="btn btn-default" data-toggle="modal" data-target="#myModal{{$i}}"  style="position:absolute;top:110px;left:105px;">
                            Edit
                          </button>

                            <a href="#"  class="btn btn-default" id="moveDownProductSlide" 
                            data-index='{{$i}}'
                            data-password = '{{ $adminPassword }}'
                            data-userid="{{$userId}}" 
                            data-order='{{$i}}'
                            data-count="{{$productSlideCount}}" 
                            data-value="{{$productTypes[$i]['value']}}" 
                            data-type="{{$productTypes[$i]['type']}}" 
                            data-url = "{{ $homeCmsLink }}/setproductslide"



                           style="position:absolute;top:110px;right:5px;">>></a>

                          <!-- Modal -->
                        <div class="modal fade" id="myModal{{$i}}" >
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Edit Product Slide</h4>
                              </div>
                                <div class="modal-body">

                                  <form method="post" id='productSlideForm' action="https://easyshop.ph.feature/webservice/homewebservice/addmainslide" onsubmit ="document.getElementById('hash2').value = hex_sha1(document.getElementById('sidebanner').value + document.getElementById('userId').value)">       
                                    <fieldset>
                                    <label for="userId" class="col-sm-2 control-label">Value</label>
                                    <div class="col-sm-10">
                                      {{ Form::hidden('password', "$adminPassword", array('id' => 'adminPassword')) }}
                                      {{ Form::text('value', $productTypes[$i]['value'], array('id' => 'productSlideValue','class' => 'form-control')) }}
                                    </div>
                                    <label for="userId" class="col-sm-2 control-label">Type</label>
                                    <div class="col-sm-10">
                                      {{ Form::text('type', $productTypes[$i]['type'], array('id' => 'productSlideType','class' => 'form-control')) }}
                                    </div>
                                    </fieldset>
                                  <br/>
                                    <a href="" class="btn btn-primary" data-dismiss = "modal"
                                    data-index='{{$i}}'
                                    data-userid="{{$userId}}" 
                                    data-order='{{$i}}'
                                    data-count="{{$productSlideCount}}" 
                                    data-url = "{{ $homeCmsLink }}/setproductslide"

                                    
                                    id='submitProductSlide'>Submit</a> 
                                  </form>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>       
                    @endfor
                  @endfor
                           
                  </div>
              
    
    
   
      </div>  
   

<!-- end -->
      </div>
    </div>
    </div>

</div>
        
    




      
  </div>

  