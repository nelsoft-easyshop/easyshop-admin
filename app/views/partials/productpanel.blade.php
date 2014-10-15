                                    <span style="display:none;">{{$productPanelindex = 0}}</span>
                                    <span style="display:none;">{{$productPanelCount = 1}}</span>
                                    <div class="col-lg-15" style='text-align:center;'>
                                        @foreach($productList as $productPanel)
                                            <div style="position:relative;display:inline-block;">
                                                <div class='well' style="height:210px;">
                                                    <p>
                                                        <img src="{{$easyShopLink}}{{ltrim($productPanel->product_image_path, '.')}}" data-div="" style="width:250px !important;height:150px !important; border: black 1px solid;" class='img-responsive'/>
                                                    </p>

                                                    <a href="#productPanel{{$productPanelindex}}" data-toggle="modal" style="position:absolute;top:180px;left:135px;"><span class="glyphicon glyphicon-edit" style="font-size:16px;"></span></a>
                                                    <a class="btn btn-default" 
                                                        id="removeProductPanel" 
                                                        data-index="{{$productPanelindex}}" 
                                                        data-nodename="productPanel" 
                                                        style="position:absolute;top:2px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/removeContent"
                                                     ><font color='red'><b>X</b></font></a>

                                                    <a 
                                                        id="moveupProductPanel" 
                                                        data-action="up" 
                                                        data-index="{{$productPanelindex}}" 
                                                        data-order="{{$productPanelindex}}" 
                                                        style="position:absolute;top:180px;left:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/setPositionProductPanel"
                                                     ><span class="glyphicon glyphicon-chevron-left pull-left" style="font-size:16px;"></span></a>

                                                     <a  
                                                        id="movedownProductPanel" 
                                                        data-action="down" 
                                                        data-index="{{$productPanelindex}}" 
                                                        data-order="{{$productPanelindex}}" 
                                                        style="position:absolute;top:180px;right:5px;"
                                                        data-url = "{{{$newHomeCmsLink}}}/setPositionProductPanel"
                                                     ><span class="glyphicon glyphicon-chevron-right pull-right" style="font-size:16px;"></span></a>
                                                 </div>
                                                 <span class="productPanelCount" style="display:none;">{{$productPanelCount}}</span>
                                                <!--Start Edit Slide Modal -->
                                                    <div class="modal fade user_modal" id="productPanel{{$productPanelindex}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title white_header" id="myModalLabel"><span class="glyphicon glyphicon-edit"></span>Edit Product Panel</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal">                                        
                                                                        <div class="form-group">
                                                                            <label for="inputPassword" class="control-label col-xs-2">Enter Slug</label>
                                                                            <div class="col-xs-10">
                                                                                <input type="text" id="value" name='value' value="{{$productPanel->slug}}" class='form-control'> 
                                                                            </div>
                                                                        </div>    
                                                                        {{ Form::hidden('index', $productPanelindex, array('id' => 'index','class' => 'form-control')) }}                                                                                              

                                                                        <button type="button" class="btn btn-primary text-center" data-dismiss="modal" data-url = "{{{$newHomeCmsLink}}}/setSellerProductPanel" id="editProductPanel">Edit Product Panel</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!--End Edit Slide Modal -->

                                            <span style="display:none;">{{$productPanelindex++}}</span>  
                                            <span style="display:none;">{{$productPanelCount++}}</span>
                                            </div>
                                        @endforeach
                                    </div>