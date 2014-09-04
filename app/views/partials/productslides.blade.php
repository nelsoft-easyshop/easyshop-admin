  <script type="text/javascript">
      $(document).ready(function(){

        $("#loading").modal('hide');

      });

  </script>       
     <div class="tab-pane fade active in" id="productSlide" onload = "success">
    
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#addProd">
                  Add Product Slide
                </a>
              </h4>
            </div>
            <div id="addProd" class="panel-collapse collapse in">
              <div class="panel-body">

                      <form action="{{$homeCmsLink}}/addproductslide" id="addProductForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="inputPassword" class="control-label col-xs-2">Value</label>
                          <div class="col-xs-10">
                            <input type="text" id="valueProductSlide" class="form-control" name='value'  placeholder="Value" >                  
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-xs-offset-2 col-xs-10">
                            <a href="#"  class="btn btn-default text-center" data-userid="{{$userId}}" data-password="{{$adminPassword}}" data-url = "{{ $homeCmsLink }}/addproductslide" id="submitAddProduct">Submit</a>
                          </div>
                        </div>
                       </form>

              </div>
            </div>
          </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#managepProd">
          Manage Product Slide
        </a>
      </h4>
    </div>
    <div id="managepProd" class="panel-collapse collapse in">
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
                      <div class='well' style="height:210px;">
                          <p><img src="{{$easyShopLink}}/{{$productSlide[$i][$y]['product_image_path']}}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive' ></p>
                          
                          <a class="btn btn-default" 
                            id="deleteMainSlide" 
                            data-index='{{$i}}'  
                            data-nodename="productSlide" 
                            data-userid="{{$userId}}"                        
                            data-password="{{$adminPassword}}"
                            style="position:absolute;top:2px;left:5px;"
                            data-url = "{{ $homeCmsLink }}/removeContent"
                           ><font color='red'><b>X</b></font></a>

                           <a  id="moveUpProductSlide" 
                            data-index='{{$i}}'
                            data-password = '{{ $adminPassword }}'
                            data-userid="{{$userId}}" 
                            data-order='{{$i}}'
                            data-count="{{$productSlideCount}}" 
                            data-value="{{$productTypes[$i]['value']}}" 
                            data-type="{{$productTypes[$i]['type']}}" 
                            data-url = "{{ $homeCmsLink }}/setproductslide"

                           style="position:absolute;top:180px;left:5px;"><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>
                              <a href="#myModal{{$i}}" data-toggle="modal" style="position:absolute;top:180px;left:135px;">
                                <span class="glyphicon glyphicon-edit" style="font-size:16px;"></span>
                              </a>

                            <a  id="moveDownProductSlide" 
                            data-index='{{$i}}'
                            data-password = '{{ $adminPassword }}'
                            data-userid="{{$userId}}" 
                            data-order='{{$i}}'
                            data-count="{{$productSlideCount}}" 
                            data-value="{{$productTypes[$i]['value']}}" 
                            data-type="{{$productTypes[$i]['type']}}" 
                            data-url = "{{ $homeCmsLink }}/setproductslide"

                           style="position:absolute;top:180px;right:5px;"><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
                      </div>

                          <!-- Modal -->
                        <div class="modal fade" id="myModal{{$i}}" >
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" style='margin-top:2px;'><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
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
                                      {{ Form::text('type', $productTypes[$i]['type'], array('id' => 'productSlideType','class' => 'form-control','readonly' => 'readonly')) }}
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

  